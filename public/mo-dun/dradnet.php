<?php
require __DIR__ . '/../includes/config.php';

$pageTitle = 'Dradnet — Phần mềm thiết kế cống tự động';
$pageDescription = 'Dradnet tự động hoá thiết kế cống tròn, cống hộp, cầu bản và hố ga theo tiêu chuẩn mới nhất.';

// Khu vực 1: Tính năng cốt lõi — lấy từ features-grid gốc trong index.html cũ.
$features = [
    'Cống Tròn & Cống Hộp Đúc Sẵn ' . MODULE_YEAR,
    'Cống Hộp Đổ Tại Chỗ ' . MODULE_YEAR,
    'Cầu Bản – Cống Bản – Tràn Liên Hợp ' . MODULE_YEAR,
    'Thiết Kế Hố Ga ' . MODULE_YEAR,
];

// Khu vực 2: Gallery — TODO(SV1): thay bằng ảnh chụp màn hình thật trong assets/images/dradnet/
$gallery = [
    'Giao diện thiết kế cống tròn',
    'Bảng tính kết cấu tự động',
    'Xuất bản vẽ CAD hoàn chỉnh',
];

require __DIR__ . '/../includes/header.php';
?>

<section>
    <span class="eyebrow">Mô-đun phần mềm</span>
    <h1 style="margin: 8px 0 10px; font-size: 1.9rem;"><?= htmlspecialchars($pageTitle) ?></h1>
    <p style="color: var(--text-muted); max-width: 60ch; margin-bottom: 40px;">
        Tự động hoá tính toán và xuất bản vẽ cho các hạng mục cống, cầu bản, hố ga theo tiêu chuẩn thiết kế mới nhất.
    </p>
</section>

<section>
    <span class="eyebrow">Khu vực 1</span>
    <h2 style="margin: 8px 0 20px; font-size: 1.4rem;">Tính năng cốt lõi</h2>
    <ul class="feature-list">
        <?php foreach ($features as $f): ?>
        <li><span class="tick-3d">&#10003;</span> <?= htmlspecialchars($f) ?></li>
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
        <a href="/bao-gia.php?mo-dun=dradnet" class="btn-3d btn-3d-red">Tính báo giá mô-đun này ngay</a>
    </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
