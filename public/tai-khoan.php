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
$history = $credit->getHistory($currentUserId, 30);
$products = $db->query('SELECT slug, product_name, credit_cost FROM products ORDER BY id ASC')->fetchAll();

$pageTitle = 'Tài khoản';
$pageDescription = 'Số dư tín dụng, lịch sử giao dịch và các mô-đun phần mềm.';
require __DIR__ . '/includes/header.php';
?>

<section>
    <span class="eyebrow">Tài khoản</span>
    <h1 style="margin: 8px 0 8px; font-size: 1.9rem;">Số Dư Tín Dụng</h1>
    <p style="font-size: 2rem; font-weight: 700; margin: 0 0 8px;"><span id="balanceValue"><?= $balance ?></span> tín dụng</p>
    <div style="display: flex; gap: 12px; margin-bottom: 32px;">
        <a href="/mua-tin-dung.php" class="btn-3d btn-3d-yellow">Mua thêm tín dụng</a>
        <a href="/api/logout.php" class="btn-3d btn-3d-blue">Đăng xuất</a>
    </div>
</section>

<section>
    <span class="eyebrow">Mô-đun phần mềm</span>
    <h2 style="margin: 8px 0 20px; font-size: 1.4rem;">Mức Trừ Tín Dụng Mỗi Lần Chạy</h2>
    <p class="card-3d__desc" style="max-width: 640px; margin-bottom: 20px;">
        Nút "Chạy thử" bên dưới mô phỏng thao tác phần mềm desktop trừ tín dụng khi khách sử dụng —
        dùng để kiểm tra hệ thống trước khi phần mềm desktop nối vào API <code>/api/consume-credit.php</code> thật.
    </p>
    <div class="card-grid">
        <?php foreach ($products as $p): ?>
        <div class="card-3d" data-slug="<?= htmlspecialchars($p['slug']) ?>">
            <div class="card-3d__title"><?= htmlspecialchars($p['product_name']) ?></div>
            <p class="card-3d__desc"><?= (int) $p['credit_cost'] ?> tín dụng / lần chạy</p>
            <button type="button" class="btn-3d btn-3d-blue btn-consume" data-slug="<?= htmlspecialchars($p['slug']) ?>" style="width:100%;">Chạy thử (trừ tín dụng)</button>
        </div>
        <?php endforeach; ?>
    </div>
    <p id="consumeMessage" style="margin-top: 16px; font-size: 0.9rem;"></p>
</section>

<section>
    <span class="eyebrow">Lịch sử</span>
    <h2 style="margin: 8px 0 20px; font-size: 1.4rem;">Lịch Sử Giao Dịch</h2>
    <?php if (!$history): ?>
    <p class="card-3d__desc">Chưa có giao dịch nào.</p>
    <?php else: ?>
    <div style="overflow-x: auto;">
        <table id="historyTable" style="width: 100%; border-collapse: collapse; font-size: 0.9rem;">
            <thead>
                <tr style="text-align: left; border-bottom: 2px solid var(--ink);">
                    <th style="padding: 8px;">Thời gian</th>
                    <th style="padding: 8px;">Loại</th>
                    <th style="padding: 8px;">Mô tả</th>
                    <th style="padding: 8px; text-align: right;">Thay đổi</th>
                    <th style="padding: 8px; text-align: right;">Số dư sau</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($history as $h): ?>
                <tr style="border-bottom: 1px solid rgba(0,0,0,0.1);">
                    <td style="padding: 8px;"><?= htmlspecialchars((string) $h['created_at']) ?></td>
                    <td style="padding: 8px;"><?= htmlspecialchars((string) $h['type']) ?></td>
                    <td style="padding: 8px;"><?= htmlspecialchars((string) $h['description']) ?></td>
                    <td style="padding: 8px; text-align: right; color: <?= $h['amount'] >= 0 ? '#2e7d32' : '#c0392b' ?>;"><?= $h['amount'] >= 0 ? '+' : '' ?><?= (int) $h['amount'] ?></td>
                    <td style="padding: 8px; text-align: right;"><?= (int) $h['balance_after'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</section>

<script>
(function () {
    var balanceEl = document.getElementById('balanceValue');
    var messageEl = document.getElementById('consumeMessage');

    document.querySelectorAll('.btn-consume').forEach(function (btn) {
        btn.addEventListener('click', function () {
            btn.disabled = true;
            messageEl.style.color = 'inherit';
            messageEl.textContent = 'Đang xử lý...';

            fetch('/api/consume-credit.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'slug=' + encodeURIComponent(btn.dataset.slug),
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
                    messageEl.textContent = 'Đã trừ tín dụng. Số dư mới: ' + res.data.balance + '. Tải lại trang để xem lịch sử cập nhật.';
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
