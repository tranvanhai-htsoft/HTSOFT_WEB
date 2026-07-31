<?php
$pageTitle = 'Hướng dẫn — Kiểm Toán Cầu Bản';
$pageDescription = 'Các bước sử dụng Phần Mềm Kiểm Toán Cầu Bản.';

// TODO(SV1): thay nội dung placeholder bằng video/GIF hướng dẫn thật cho từng bước.
$steps = [
    [
        'title' => 'Bước 1: Khai báo loại dầm bản và tải trọng',
        'desc' => 'Chọn bản đặc/bản rỗng, thường hoặc dự ứng lực, phần mềm tự động tổ hợp tải trọng theo TCVN 11823/AASHTO.',
    ],
    [
        'title' => 'Bước 2: Xem biểu đồ nội lực tại mặt cắt nguy hiểm',
        'desc' => 'Kiểm tra biểu đồ mô-men, lực cắt do phần mềm tự động phân tích và xuất.',
    ],
    [
        'title' => 'Bước 3: Đọc kết quả kiểm toán bền và sử dụng',
        'desc' => 'Xem kết quả kiểm tra điều kiện bền, nứt, độ võng và độ mỏi của kết cấu.',
    ],
];

require __DIR__ . '/../includes/header.php';
?>

<section>
    <h1 style="margin: 8px 0 10px; font-size: 1.9rem;"><?= htmlspecialchars($pageTitle) ?></h1>
    <p style="color: var(--text-muted); max-width: 60ch; margin-bottom: 32px;">
        Làm theo 3 bước dưới đây. Bấm vào từng bước để xem chi tiết, không cần chuyển trang.
    </p>

    <div class="guide-roadmap">
        <?php foreach ($steps as $i => $step): $n = $i + 1; ?>
        <div class="guide-step<?= $n === 1 ? ' is-open' : '' ?>">
            <button type="button" class="guide-step__marker">
                <span class="guide-step__num"><?= $n ?></span>
                <span class="guide-step__title"><?= htmlspecialchars($step['title']) ?></span>
            </button>
            <div class="guide-step__content">
                <p><?= htmlspecialchars($step['desc']) ?></p>
                <div class="guide-step__video">Video hướng dẫn 30 giây–2 phút chưa cập nhật</div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
