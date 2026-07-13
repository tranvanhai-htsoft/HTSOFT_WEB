<?php
$pageTitle = 'Trang chủ';
$pageDescription = 'HTSOFT — bộ phần mềm quản trị doanh nghiệp: kho, kế toán, bán hàng, báo cáo.';

// TODO(Admin): danh sách mô-đun dưới đây là nội dung nháp copy từ Gioithieu.html gốc.
// Chốt lại tên/mô tả/thứ tự 4 thẻ thật (có tính Dradnet vào đây không, vì domain là dradnet.vn?)
$modules = [
    [
        'icon' => '📦',
        'title' => 'Mô-đun Quản Lý Kho',
        'desc' => 'Kiểm soát xuất nhập tồn vật tư theo thời gian thực, tự động cảnh báo giới hạn an toàn.',
        'href' => '/mo-dun/quan-ly-kho.php',
    ],
    [
        'icon' => '💰',
        'title' => 'Mô-đun Kế Toán',
        'desc' => 'Tự động định khoản thu chi, kết xuất báo cáo tài chính nội bộ nhanh chóng và chính xác.',
        'href' => '/mo-dun/ke-toan.php',
    ],
    [
        'icon' => '🛒',
        'title' => 'Mô-đun Bán Hàng',
        'desc' => 'Lên đơn hàng siêu tốc, quản lý công nợ khách hàng và lịch sử chăm sóc khách hàng.',
        'href' => '/mo-dun/ban-hang.php',
    ],
    [
        'icon' => '📊',
        'title' => 'Mô-đun Báo Cáo',
        'desc' => 'Hệ thống biểu đồ trực quan, phân tích dữ liệu chuyên sâu giúp tối ưu dòng tiền.',
        'href' => '/mo-dun/bao-cao.php',
    ],
];

require __DIR__ . '/includes/header.php';
?>

<section>
    <span class="eyebrow">Danh mục phần mềm</span>
    <h1 style="margin: 8px 0 30px; font-size: 1.9rem;">Danh Mục Các Mô-đun Phần Mềm</h1>

    <div class="card-grid">
        <?php foreach ($modules as $m): ?>
        <a href="<?= htmlspecialchars($m['href']) ?>" class="card-3d">
            <div class="card-3d__icon"><?= $m['icon'] ?></div>
            <div class="card-3d__title"><?= htmlspecialchars($m['title']) ?></div>
            <p class="card-3d__desc"><?= htmlspecialchars($m['desc']) ?></p>
            <span class="btn-3d btn-3d-yellow">Xem chi tiết ➔</span>
        </a>
        <?php endforeach; ?>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
