<?php
require __DIR__ . '/../includes/config.php';

$pageTitle = 'Mô-đun 2: Cống Hộp Đổ Tại Chỗ ' . MODULE_YEAR;
$pageDescription = 'Thiết kế kết cấu cống hộp đổ tại chỗ, tường cánh BTCT, tự động dựng và xuất bản vẽ phối cảnh 3D.';

$features = [
    'Thư viện chuẩn quốc gia' => 'Trang bị đầy đủ các mẫu bố trí cốt thép tiêu chuẩn, phổ biến trên cả nước.',
    'Thiết kế toàn diện' => 'Hỗ trợ thiết kế kết cấu tường cánh bê tông và bê tông cốt thép (BTCT).',
    'Kết cấu linh hoạt' => 'Xử lý linh hoạt kết cấu cống xiên, cống nối dài và hệ thống hầm chui dân sinh.',
    'Hạ tầng thủy lợi' => 'Hỗ trợ mô hình cống kết hợp kênh mương thủy lợi hoặc kết hợp tường chắn địa hình.',
    'Trực quan hóa 3D' => 'Tính năng đột phá tự động dựng và xuất kèm bản vẽ phối cảnh 3D trực quan.',
];

$gallery = [
    'Bố trí cốt thép cống hộp tiêu chuẩn',
    'Kết cấu tường cánh BTCT',
    'Bản vẽ phối cảnh 3D tự động',
];

require __DIR__ . '/../includes/header.php';
?>

<section>
    <span class="eyebrow">Mô-đun phần mềm</span>
    <h1 style="margin: 8px 0 10px; font-size: 1.9rem;"><?= htmlspecialchars($pageTitle) ?></h1>
    <p style="color: var(--text-muted); max-width: 60ch; margin-bottom: 40px;">
        <?= htmlspecialchars($pageDescription) ?>
    </p>
</section>

<section>
    <span class="eyebrow">Khu vực 1</span>
    <h2 style="margin: 8px 0 20px; font-size: 1.4rem;">Tính năng cốt lõi</h2>
    <ul class="feature-list">
        <?php foreach ($features as $label => $desc): ?>
        <li><span class="tick-3d">&#10003;</span> <strong><?= htmlspecialchars($label) ?>:</strong>&nbsp;<?= htmlspecialchars($desc) ?></li>
        <?php endforeach; ?>
    </ul>
</section>

<section>
    <span class="eyebrow">Khu vực 2</span>
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
    <span class="eyebrow">Khu vực 3</span>
    <h2 style="margin: 8px 0 20px; font-size: 1.4rem;">Video giới thiệu ngắn</h2>
    <div class="card-3d" style="align-items: center; text-align: center; max-width: 560px; margin: 0 auto;">
        <div style="width: 100%; aspect-ratio: 16 / 9; background: var(--ink); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 0.9rem;">
            Video 30s–1 phút chưa cập nhật
        </div>
        <a href="/bao-gia.php?mo-dun=cong-hop-do-tai-cho" class="btn-3d btn-3d-red">Tính báo giá mô-đun này ngay</a>
    </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
