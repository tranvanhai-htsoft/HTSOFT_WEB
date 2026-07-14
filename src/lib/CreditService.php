<?php

namespace Htsoft\Lib;

use PDO;

/**
 * Quản lý tín dụng trả trước — dùng chung cho mọi sản phẩm, theo yêu cầu Admin
 * (thay thế mô hình thuê bao theo tháng mô tả ban đầu trong CAUTAOWEB.docx).
 *
 * Quy tắc: users.credit_balance là cache, PHẢI luôn khớp
 * SUM(credit_transactions.amount) của user đó. Mọi thay đổi số dư bắt buộc
 * đi qua topUp()/consume()/adjust() — không UPDATE trực tiếp credit_balance
 * ở nơi khác, để lịch sử (credit_transactions) không bao giờ bị lệch với số dư.
 */
final class CreditService
{
    private const DEFAULT_LOW_THRESHOLD = 20;

    public function __construct(
        private readonly PDO $db,
    ) {
    }

    public function getBalance(int $userId): int
    {
        $stmt = $this->db->prepare('SELECT credit_balance FROM users WHERE id = ? LIMIT 1');
        $stmt->execute([$userId]);
        $balance = $stmt->fetchColumn();

        return $balance === false ? 0 : (int) $balance;
    }

    public function isLowBalance(int $userId): bool
    {
        $stmt = $this->db->prepare('SELECT credit_balance, low_credit_threshold FROM users WHERE id = ? LIMIT 1');
        $stmt->execute([$userId]);
        $row = $stmt->fetch();

        if ($row === false) {
            return false;
        }

        $threshold = $row['low_credit_threshold'] !== null
            ? (int) $row['low_credit_threshold']
            : self::DEFAULT_LOW_THRESHOLD;

        return (int) $row['credit_balance'] <= $threshold;
    }

    /**
     * Nạp tín dụng từ 1 gói đã mua. Trả về số dư mới.
     */
    public function topUp(int $userId, int $packageId): int
    {
        $stmt = $this->db->prepare(
            'SELECT credit_amount, package_name FROM credit_packages WHERE id = ? AND is_active = 1 LIMIT 1'
        );
        $stmt->execute([$packageId]);
        $package = $stmt->fetch();

        if ($package === false) {
            throw new \InvalidArgumentException("Gói tín dụng #{$packageId} không tồn tại hoặc đã ngừng bán.");
        }

        return $this->recordTransaction(
            userId: $userId,
            type: 'topup',
            amount: (int) $package['credit_amount'],
            description: 'Mua ' . $package['package_name'],
            creditPackageId: $packageId,
        );
    }

    /**
     * Trừ tín dụng khi khách dùng 1 sản phẩm. Trả về số dư mới.
     *
     * @throws InsufficientCreditException nếu số dư không đủ
     */
    public function consume(int $userId, int $productId): int
    {
        $stmt = $this->db->prepare(
            'SELECT credit_cost, product_name FROM products WHERE id = ? LIMIT 1'
        );
        $stmt->execute([$productId]);
        $product = $stmt->fetch();

        if ($product === false) {
            throw new \InvalidArgumentException("Sản phẩm #{$productId} không tồn tại.");
        }

        $cost = (int) $product['credit_cost'];

        if ($this->getBalance($userId) < $cost) {
            throw new InsufficientCreditException(
                "Không đủ tín dụng để dùng \"{$product['product_name']}\" (cần {$cost})."
            );
        }

        return $this->recordTransaction(
            userId: $userId,
            type: 'usage',
            amount: -$cost,
            description: 'Sử dụng ' . $product['product_name'],
            productId: $productId,
        );
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function getHistory(int $userId, int $limit = 50): array
    {
        $stmt = $this->db->prepare(
            'SELECT type, amount, balance_after, description, created_at
             FROM credit_transactions
             WHERE user_id = ?
             ORDER BY created_at DESC, id DESC
             LIMIT ?'
        );
        $stmt->bindValue(1, $userId, PDO::PARAM_INT);
        $stmt->bindValue(2, $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    private function recordTransaction(
        int $userId,
        string $type,
        int $amount,
        string $description,
        ?int $productId = null,
        ?int $creditPackageId = null,
    ): int {
        $this->db->beginTransaction();

        try {
            $stmt = $this->db->prepare('SELECT credit_balance FROM users WHERE id = ? FOR UPDATE');
            $stmt->execute([$userId]);
            $currentBalance = (int) $stmt->fetchColumn();
            $newBalance = $currentBalance + $amount;

            if ($newBalance < 0) {
                throw new InsufficientCreditException('Số dư tín dụng không đủ để thực hiện giao dịch này.');
            }

            $insert = $this->db->prepare(
                'INSERT INTO credit_transactions
                    (user_id, type, amount, balance_after, product_id, credit_package_id, description)
                 VALUES (?, ?, ?, ?, ?, ?, ?)'
            );
            $insert->execute([$userId, $type, $amount, $newBalance, $productId, $creditPackageId, $description]);

            $update = $this->db->prepare('UPDATE users SET credit_balance = ? WHERE id = ?');
            $update->execute([$newBalance, $userId]);

            $this->db->commit();

            return $newBalance;
        } catch (\Throwable $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
}
