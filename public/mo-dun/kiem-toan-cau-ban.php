<?php
$pageTitle = 'Phần Mềm Kiểm Toán Cầu Bản';
$pageDescription = 'Tự động tính nội lực và kiểm toán kết cấu dầm bản theo TCVN 11823, AASHTO LRFD.';

$features = [
    'Tự động tổ hợp tải trọng' => 'Tự động xác định, phân bổ và tổ hợp các loại tải trọng (tĩnh tải, hoạt tải xe, tác động môi trường...) theo đúng các tiêu chuẩn thiết kế hiện hành (TCVN 11823, AASHTO LRFD), loại bỏ hoàn toàn việc tính toán thủ công phức tạp.',
    'Tính toán nội lực chính xác' => 'Tích hợp lõi xử lý mạnh mẽ, tự động phân tích và xuất biểu đồ nội lực (mô-men, lực cắt) tại các mặt cắt nguy hiểm một cách trực quan và nhanh chóng.',
    'Kiểm toán toàn diện kết cấu dầm bản' => 'Hỗ trợ đa dạng các loại dầm bản (bản đặc, bản rỗng, bản bê tông cốt thép thường hoặc bê tông dự ứng lực). Tự động kiểm tra các điều kiện bền, điều kiện sử dụng (nứt, độ võng) và độ mỏi của kết cấu.',
];

$gallery = [
    'Tổ hợp tải trọng theo TCVN 11823/AASHTO',
    'Biểu đồ mô-men, lực cắt tại mặt cắt nguy hiểm',
    'Kiểm toán dầm bản đặc/rỗng, dự ứng lực',
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
        <a href="/bao-gia.php?mo-dun=kiem-toan-cau-ban" class="btn-3d btn-3d-red">Tính báo giá mô-đun này ngay</a>
    </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
