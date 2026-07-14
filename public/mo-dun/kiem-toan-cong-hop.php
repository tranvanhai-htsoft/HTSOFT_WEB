<?php
$pageTitle = 'Phần Mềm Kiểm Toán Cống Hộp';
$pageDescription = 'Tự động tính nội lực khung kín và kiểm toán kết cấu cống hộp, tối ưu khối lượng vật liệu.';

$features = [
    'Tự động tổ hợp tải trọng phức tạp' => 'Tự động tính toán và áp dụng các loại tải trọng đặc thù tác động lên cống hộp bao gồm: áp lực đất (thẳng đứng, chủ động, bị động), áp lực nước (trong và ngoài cống), tĩnh tải bản thân, và hoạt tải xe trên mặt đường theo đúng tiêu chuẩn hiện hành.',
    'Tính toán nội lực hệ khung kín' => 'Tự động phân tích nội lực (mô-men, lực cắt, lực dọc) cho sơ đồ kết cấu khung kín (cống đơn, cống đôi, hoặc cống nhiều vách ngăn). Xuất biểu đồ nội lực trực quan tại mọi vị trí thành bên, bản nắp và bản đáy.',
    'Kiểm toán toàn diện kết cấu cống hộp' => 'Tự động tính toán diện tích cốt thép yêu cầu, kiểm toán khả năng chịu lực của bê tông cốt thép, kiểm tra điều kiện chống nứt, độ võng và các trạng thái giới hạn (TTGH sử dụng, TTGH cường độ) giúp tối ưu hóa khối lượng vật liệu.',
];

$gallery = [
    'Sơ đồ tải trọng đất, nước tác động cống hộp',
    'Biểu đồ nội lực khung kín',
    'Kết quả kiểm toán TTGH cường độ/sử dụng',
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
        <a href="/bao-gia.php?mo-dun=kiem-toan-cong-hop" class="btn-3d btn-3d-red">Tính báo giá mô-đun này ngay</a>
    </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
