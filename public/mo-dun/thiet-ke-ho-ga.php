<?php
require __DIR__ . '/../includes/config.php';

$pageTitle = 'Mô-đun 4: Thiết Kế Hố Ga ' . MODULE_YEAR;
$pageDescription = 'Thư viện mẫu hố ga đa dạng, thiết kế mạng lưới thoát nước và xuất khối lượng tự động.';

$features = [
    'Thư viện mẫu đa dạng' => 'Lưu trữ hàng chục mẫu hố ga thông dụng (ga thăm, ga thu thâm, ga vỉa hè, ga lòng đường).',
    'Mạng lưới chuyên sâu' => 'Thiết kế chuyên sâu mạng lưới ga thu nước mưa và hệ thống ga thoát nước thải riêng biệt.',
    'Xử lý giao phức tạp' => 'Giải quyết triệt để các nút giao phức tạp như ga kết hợp cống hộp khổ lớn.',
    'Vật liệu hiện đại' => 'Cấu tạo chi tiết từ hố thu, máng thu, hệ thống đan bê tông cho đến các loại nắp composite hiện đại.',
    'Xuất khối lượng tự động' => 'Vẽ chi tiết cốt thép hàng loạt hố ga, đồng thời xuất bảng khối lượng kèm diễn giải chi tiết từng cấu kiện.',
];

$gallery = [
    'Thư viện mẫu hố ga thông dụng',
    'Mạng lưới ga thu nước mưa',
    'Bảng khối lượng xuất tự động',
];

require __DIR__ . '/../includes/header.php';
?>

<section>
    <h1 style="margin: 8px 0 10px; font-size: 1.9rem;"><?= htmlspecialchars($pageTitle) ?></h1>
    <p style="color: var(--text-muted); max-width: 60ch; margin-bottom: 40px;">
        <?= htmlspecialchars($pageDescription) ?>
    </p>
</section>

<section>
    <h2 style="margin: 8px 0 20px; font-size: 1.4rem;">Tính năng cốt lõi</h2>
    <ul class="feature-list">
        <?php foreach ($features as $label => $desc): ?>
        <li><span class="tick-3d">&#10003;</span> <strong><?= htmlspecialchars($label) ?>:</strong>&nbsp;<?= htmlspecialchars($desc) ?></li>
        <?php endforeach; ?>
    </ul>
</section>

<section>
    <h2 style="margin: 8px 0 20px; font-size: 1.4rem;">Hình ảnh sản phẩm</h2>
    <div class="card-grid" style="grid-template-columns: repeat(3, 1fr);">
        <?php foreach ($gallery as $caption): ?>
        <div class="card-3d" style="align-items: center; text-align: center;">
            <div style="width: 100%; aspect-ratio: 4 / 3; background: var(--bg-color); border: 2px dashed var(--ink); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: var(--text-muted); font-size: 0.85rem;">
                Ảnh chưa cập nhật
            </div>
            <p class="card-3d__desc"><?= htmlspecialchars($caption) ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<section>
    <h2 style="margin: 8px 0 20px; font-size: 1.4rem;">Video giới thiệu ngắn</h2>
    <div class="card-3d" style="align-items: center; text-align: center; max-width: 560px; margin: 0 auto;">
        <div style="width: 100%; aspect-ratio: 16 / 9; background: var(--ink); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 0.9rem;">
            Video 30s–1 phút chưa cập nhật
        </div>
        <a href="/bao-gia.php?mo-dun=thiet-ke-ho-ga" class="btn-3d btn-3d-red">Tính báo giá mô-đun này ngay</a>
    </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
