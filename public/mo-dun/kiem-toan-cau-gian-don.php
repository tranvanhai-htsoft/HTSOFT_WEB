<?php
$pageTitle = 'Phần Mềm Kiểm Toán Cầu Giản Đơn';
$pageDescription = 'Tự động tổ hợp tải trọng, xếp xe HL-93 và kiểm toán toàn diện dầm cầu theo TCVN 11823.';

$features = [
    'Tự động tổ hợp tải trọng và xếp xe' => 'Tự động tính toán hệ số phân phối ngang (theo phương pháp đòn bẩy, định luật Courbon hoặc dầm trên nền đàn hồi). Tự động xếp hoạt tải xe (HL-93, người đi) để tìm ra nội lực bất lợi nhất tại các mặt cắt.',
    'Tính toán nội lực và đặc trưng hình học' => 'Tự động tính toán các đặc trưng mặt cắt (bao gồm cả hiệu ứng liên hợp giữa dầm và bản mặt cầu). Phân tích nội lực chính xác cho từng giai đoạn thi công (đúc dầm, căng kéo cốt thép, đổ bê tông bản mặt cầu, hao hụt dự ứng lực).',
    'Kiểm toán toàn diện theo tiêu chuẩn' => 'Tự động kiểm toán trạng thái giới hạn cường độ (uốn, cắt, xoắn), trạng thái giới hạn sử dụng (kiểm soát nứt, độ võng, ứng suất trong bê tông và cốt thép dự ứng lực) và trạng thái giới hạn mỏi.',
];

$gallery = [
    'Sơ đồ xếp xe HL-93 tìm nội lực bất lợi',
    'Biểu đồ nội lực theo giai đoạn thi công',
    'Kết quả kiểm toán trạng thái giới hạn',
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
        <a href="/bao-gia.php?mo-dun=kiem-toan-cau-gian-don" class="btn-3d btn-3d-red">Tính báo giá mô-đun này ngay</a>
    </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
