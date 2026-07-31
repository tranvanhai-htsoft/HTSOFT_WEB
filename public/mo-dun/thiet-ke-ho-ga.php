<?php
$pageTitle = 'Mô-đun 04: Thiết Kế Hố Ga';
$pageDescription = 'Thư viện mẫu hố ga đa dạng, thiết kế mạng lưới thoát nước và xuất khối lượng tự động.';

$features = [
    'Thư viện mẫu đa dạng' => 'Tích hợp chức năng thiết kế hàng chục mẫu hố ga thông dụng của các địa phương trên cả nước như ga thăm, ga thu thăm, ga vỉa hè, lòng đường, ga nước mưa và nước thải.',
    'Đấu nối linh hoạt' => 'Cho phép đấu nối trực tiếp hoặc xây dựng đấu nối thông qua Excel với hệ thống cống tròn, cống hộp và mương thoát nước.',
    'Hiệu chỉnh tham số tự động' => 'Cho phép gán đồng thời tham số cho hàng loạt ga, hỗ trợ lưu và tải mẫu các loại ga một cách nhanh chóng và linh hoạt.',
    'Mẫu ga chuyên dụng' => 'Thiết kế ga bán lắp ghép, ga sân bay, đấu nối cống hộp khổ lớn.',
    'Bố trí cốt thép' => 'Tùy chọn linh hoạt bố trí một lưới thép thân ga hoặc hai lưới thép theo yêu cầu chịu lực.',
    'Xuất khối lượng chi tiết' => 'Xuất khối lượng hàng loạt ga qua Excel; tự động phân tách mỗi ga một sheet kèm công thức diễn giải và bảng tổng hợp chung ở sheet cuối cùng.',
];

$gallery = [
    'Thư viện mẫu hố ga thông dụng',
    'Mạng lưới ga thu nước mưa',
    'Bảng khối lượng xuất tự động',
];

require __DIR__ . '/../includes/header.php';
?>

<section style="text-align: left;">
    <h1 style="margin: 0 0 28px; font-size: 1.9rem; text-align: left;"><?= htmlspecialchars($pageTitle) ?></h1>
</section>

<section>
    <h2 style="margin: 8px 0 20px; font-size: 1.4rem;">Tính năng cốt lõi</h2>
    <ul class="feature-list feature-list--minimal">
        <?php foreach ($features as $label => $desc): ?>
        <li><span class="feature-dot" aria-hidden="true"></span> <strong><?= htmlspecialchars($label) ?></strong> &mdash; <?= htmlspecialchars($desc) ?></li>
        <?php endforeach; ?>
    </ul>
</section>

<style>
    .feature-list--minimal li { align-items: flex-start; }
    .feature-dot {
        flex-shrink: 0;
        display: inline-block;
        width: 6px;
        height: 6px;
        margin-top: 0.55em;
        border-radius: 50%;
        background: var(--text-muted, #888);
    }
</style>

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
