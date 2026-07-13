<?php
$pageTitle = 'Mô-đun 1: Cống Tròn & Cống Hộp Đúc Sẵn 2026';
$pageDescription = 'Thiết kế nhanh cống tròn, cống hộp đúc sẵn, tự động tính bẻ góc và tích hợp giải pháp cống đô thị.';

$features = [
    'Hỗ trợ đầy đủ chủng loại' => 'Thiết kế nhanh các loại cống tròn, cống hộp đúc sẵn thông dụng trên thị trường.',
    'Thiết kế chuyên dụng' => 'Tối ưu riêng cho các công trình miền núi (độ dốc lớn, gia cố hạ lưu phức tạp).',
    'Giải pháp cống đô thị' => 'Tích hợp đồng bộ giải pháp hệ thống cống đi kèm hố ga thu nước.',
    'Tự động tính toán' => 'Tự động tính toán bẻ góc bản vẽ hệ thống cống xiên chính xác theo tim tuyến.',
    'Đồng bộ nâng cấp' => 'Mô hình thông minh xử lý cống nối dài, nâng cấp cải tạo theo cao độ đứt cũ.',
];

$gallery = [
    'Giao diện thiết kế cống tròn đúc sẵn',
    'Bố trí cống hộp công trình miền núi',
    'Bản vẽ hệ thống cống xiên tự động bẻ góc',
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
        <a href="/bao-gia.php?mo-dun=cong-tron-cong-hop-duc-san" class="btn-3d btn-3d-red">Tính báo giá mô-đun này ngay</a>
    </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
