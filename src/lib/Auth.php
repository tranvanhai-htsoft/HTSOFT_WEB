<?php

namespace Htsoft\Lib;

use PDO;

/**
 * Luồng đăng nhập tối giản bằng số điện thoại — theo docs/CAUTAOWEB.docx Giai đoạn 1:
 *   1. Khách nhập SĐT.
 *   2. Có tài khoản -> yêu cầu nhập mật khẩu.
 *      Chưa có -> tạo tài khoản mới + sinh mật khẩu 6 số ngẫu nhiên.
 *   3. Gửi mật khẩu qua ZaloClient::sendOtp() (Zalo ZNS/ZCA hoặc SMS OTP).
 */
final class Auth
{
    public function __construct(
        private readonly PDO $db,
        private readonly ZaloClient $zalo,
    ) {
    }

    public function phoneExists(string $phoneNumber): bool
    {
        $stmt = $this->db->prepare('SELECT id FROM users WHERE phone_number = ? LIMIT 1');
        $stmt->execute([$phoneNumber]);

        return (bool) $stmt->fetchColumn();
    }

    public function verifyPassword(string $phoneNumber, string $password): bool
    {
        $stmt = $this->db->prepare('SELECT password FROM users WHERE phone_number = ? LIMIT 1');
        $stmt->execute([$phoneNumber]);
        $hash = $stmt->fetchColumn();

        return $hash !== false && password_verify($password, $hash);
    }

    /**
     * Tạo tài khoản mới, sinh mật khẩu 6 số, gửi qua Zalo/SMS, trả về id user mới.
     */
    public function registerWithGeneratedPassword(string $phoneNumber): int
    {
        $plainPassword = (string) random_int(100000, 999999);
        $hash = password_hash($plainPassword, PASSWORD_BCRYPT);

        $stmt = $this->db->prepare(
            'INSERT INTO users (phone_number, password, status) VALUES (?, ?, ?)'
        );
        $stmt->execute([$phoneNumber, $hash, 'active']);

        $this->zalo->sendOtp($phoneNumber, $plainPassword);

        return (int) $this->db->lastInsertId();
    }
}
