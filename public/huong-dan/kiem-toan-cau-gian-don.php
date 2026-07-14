<?php
$pageTitle = 'Hướng dẫn — Kiểm Toán Cầu Giản Đơn';
$pageDescription = 'Các bước sử dụng Phần Mềm Kiểm Toán Cầu Giản Đơn.';

// TODO(SV1): thay nội dung placeholder bằng video/GIF hướng dẫn thật cho từng bước.
$steps = [
    [
        'title' => 'Bước 1: Khai báo mặt cắt và xếp hoạt tải xe',
        'desc' => 'Nhập đặc trưng mặt cắt dầm, để phần mềm tự động xếp xe HL-93 tìm nội lực bất lợi nhất tại các mặt cắt.',
    ],
    [
        'title' => 'Bước 2: Xem nội lực theo từng giai đoạn thi công',
        'desc' => 'Kiểm tra kết quả phân tích nội lực qua các giai đoạn đúc dầm, căng kéo cốt thép, đổ bê tông bản mặt cầu.',
    ],
    [
        'title' => 'Bước 3: Đọc kết quả kiểm toán trạng thái giới hạn',
        'desc' => 'Xem kết quả kiểm toán cường độ, sử dụng và mỏi, xuất báo cáo kiểm toán hoàn chỉnh.',
    ],
];

require __DIR__ . '/../includes/header.php';
?>

<section>
    <span class="eyebrow">Hướng dẫn sử dụng</span>
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
