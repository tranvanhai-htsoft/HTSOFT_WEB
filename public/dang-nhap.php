<?php
$pageTitle = 'Đăng nhập';
$pageDescription = 'Đăng nhập chỉ bằng số điện thoại — mật khẩu gửi qua Zalo/SMS.';
require __DIR__ . '/includes/header.php';
?>

<section>
    <span class="eyebrow">Đăng nhập</span>
    <h1 style="margin: 8px 0 20px; font-size: 1.9rem;">Đăng Nhập Bằng Số Điện Thoại</h1>

    <form class="card-3d" style="max-width: 420px; gap: 16px;" method="post" action="/api/check-phone.php">
        <label for="phone" style="font-weight: 700; font-size: 0.9rem;">Số điện thoại</label>
        <input type="tel" id="phone" name="phone_number" required
               placeholder="09xxxxxxxx"
               style="padding: 10px 12px; border: 2px solid var(--ink); border-radius: 8px; font-size: 1rem;">
        <button type="submit" class="btn-3d btn-3d-blue">Tiếp tục</button>
    </form>

    <p style="color: var(--text-muted); font-size: 0.85rem; max-width: 60ch; margin-top: 16px;">
        Nếu số điện thoại đã có tài khoản, hệ thống hiện ô nhập mật khẩu.
        Nếu chưa có, hệ thống tự tạo tài khoản mới và gửi mật khẩu 6 số qua Zalo ZNS/SMS.
    </p>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
