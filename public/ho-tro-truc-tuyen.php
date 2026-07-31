<?php
$pageTitle = 'Hỗ trợ trực tuyến';
$pageDescription = 'Kết nối với kỹ thuật viên HTSOFT qua UltraView để được hỗ trợ trực tiếp trên máy tính của bạn.';

require __DIR__ . '/includes/header.php';
?>

<section>
    <h1 style="margin: 8px 0 10px; font-size: 1.9rem;">Hỗ Trợ Trực Tuyến Qua UltraView</h1>
    <p style="color: var(--text-muted); max-width: 60ch; margin-bottom: 32px;">
        Kỹ thuật viên HTSOFT sẽ kết nối trực tiếp vào máy tính của bạn qua UltraView để hỗ trợ
        xử lý sự cố hoặc hướng dẫn thao tác trực tiếp.
    </p>

    <div class="card-3d" style="max-width: 480px; gap: 16px;">
        <ol style="padding-left: 20px; color: var(--text-muted); font-size: 0.9rem; display: flex; flex-direction: column; gap: 10px;">
            <li>Mở phần mềm UltraView đã cài trên máy tính (nếu chưa có, liên hệ hotline để được gửi link tải).</li>
            <li>Đọc ID và Mật khẩu hiển thị trên màn hình UltraView.</li>
            <li>Gọi hotline bên dưới và đọc ID/Mật khẩu cho kỹ thuật viên.</li>
        </ol>
        <a href="tel:0905887868" class="btn-3d btn-3d-yellow">📞 Gọi hotline: 0905.88.78.68</a>
        <p style="font-size: 0.85rem; color: var(--text-muted); font-style: italic;">
            TODO(Admin): điền thêm số Zalo hỗ trợ và link tải UltraView chính thức vào trang này.
        </p>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
