<?php
$pageTitle = 'Bộ tính báo giá';
$pageDescription = 'Chọn mô-đun và số lượng người dùng để nhận báo giá ngay.';
require __DIR__ . '/includes/header.php';
?>

<section>
    <span class="eyebrow">Pricing calculator</span>
    <h1 style="margin: 8px 0 20px; font-size: 1.9rem;">Bộ Tính Báo Giá</h1>
    <div class="card-3d" style="max-width: 520px;">
        <p class="card-3d__desc">
            TODO(SV2): tích chọn mô-đun (checkbox) + thanh trượt số lượng người dùng/thời hạn,
            tính tổng tiền realtime, sau đó hiện nút "Đăng ký dùng thử / Xem chi tiết" kích hoạt
            luồng đăng nhập bằng SĐT trong <code>src/lib/Auth.php</code>.
        </p>
        <button type="button" class="btn-3d btn-3d-yellow">Nhận báo giá</button>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
