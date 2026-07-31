<?php
require __DIR__ . '/includes/session.php';

if ($currentUserId === null) {
    header('Location: /dang-nhap.php');
    exit;
}

require_once dirname(__DIR__) . '/src/bootstrap.php';

use Htsoft\Lib\CreditService;
use Htsoft\Lib\Database;

$db = Database::connection();
$credit = new CreditService($db);
$balance = $credit->getBalance($currentUserId);

$packages = $db->query('SELECT id, package_name, credit_amount, price FROM credit_packages WHERE is_active = 1 ORDER BY credit_amount ASC')->fetchAll();

$pageTitle = 'Mua tín dụng';
$pageDescription = 'Mua gói tín dụng trả trước, dùng chung cho mọi mô-đun phần mềm.';
require __DIR__ . '/includes/header.php';
?>

<section>
    <h1 style="margin: 8px 0 8px; font-size: 1.9rem;">Mua Gói Tín Dụng</h1>
    <p class="card-3d__desc" style="max-width: 640px; margin-bottom: 8px;">
        Tín dụng dùng chung cho tất cả mô-đun — mỗi lần chạy phần mềm sẽ trừ một số tín dụng cố định
        tuỳ mô-đun. Xem chi tiết mức trừ tại <a href="/tai-khoan.php">trang tài khoản</a>.
    </p>
    <p style="font-weight: 700; margin-bottom: 28px;">Số dư hiện tại: <span id="currentBalance"><?= $balance ?></span> tín dụng</p>

    <div class="card-grid">
        <?php foreach ($packages as $p): ?>
        <div class="card-3d" data-package-id="<?= (int) $p['id'] ?>">
            <div class="card-3d__title"><?= htmlspecialchars($p['package_name']) ?></div>
            <p class="card-3d__desc"><?= (int) $p['credit_amount'] ?> tín dụng</p>
            <p style="font-weight: 700; font-size: 1.1rem;"><?= number_format((float) $p['price'], 0, ',', '.') ?>đ</p>
            <button type="button" class="btn-3d btn-3d-yellow btn-buy-package" data-package-id="<?= (int) $p['id'] ?>" style="width:100%;">Mua gói này</button>
        </div>
        <?php endforeach; ?>
    </div>

    <p id="buyMessage" style="margin-top: 20px; font-size: 0.9rem;"></p>
</section>

<script>
(function () {
    var balanceEl = document.getElementById('currentBalance');
    var messageEl = document.getElementById('buyMessage');

    document.querySelectorAll('.btn-buy-package').forEach(function (btn) {
        btn.addEventListener('click', function () {
            btn.disabled = true;
            messageEl.style.color = 'inherit';
            messageEl.textContent = 'Đang xử lý...';

            fetch('/api/topup-credit.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'package_id=' + encodeURIComponent(btn.dataset.packageId),
            })
                .then(function (r) { return r.json().then(function (data) { return { ok: r.ok, data: data }; }); })
                .then(function (res) {
                    btn.disabled = false;
                    if (!res.ok) {
                        messageEl.style.color = '#c0392b';
                        messageEl.textContent = res.data.error || 'Có lỗi xảy ra.';
                        return;
                    }
                    balanceEl.textContent = res.data.balance;
                    messageEl.style.color = '#2e7d32';
                    messageEl.textContent = 'Nạp tín dụng thành công! Số dư mới: ' + res.data.balance + ' tín dụng.';
                })
                .catch(function () {
                    btn.disabled = false;
                    messageEl.style.color = '#c0392b';
                    messageEl.textContent = 'Không kết nối được máy chủ.';
                });
        });
    });
})();
</script>

<?php require __DIR__ . '/includes/footer.php'; ?>
