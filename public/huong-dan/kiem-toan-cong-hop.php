<?php
$pageTitle = 'Hướng dẫn — Kiểm Toán Cống Hộp';
$pageDescription = 'Các bước sử dụng Phần Mềm Kiểm Toán Cống Hộp.';

// TODO(SV1): thay nội dung placeholder bằng video/GIF hướng dẫn thật cho từng bước.
$steps = [
    [
        'title' => 'Bước 1: Khai báo sơ đồ cống và tải trọng đất/nước',
        'desc' => 'Chọn cống đơn, cống đôi hoặc nhiều vách ngăn, nhập áp lực đất và áp lực nước tác động.',
    ],
    [
        'title' => 'Bước 2: Xem biểu đồ nội lực hệ khung kín',
        'desc' => 'Kiểm tra biểu đồ mô-men, lực cắt, lực dọc tại thành bên, bản nắp và bản đáy.',
    ],
    [
        'title' => 'Bước 3: Đọc kết quả kiểm toán và tối ưu vật liệu',
        'desc' => 'Xem kết quả kiểm toán trạng thái giới hạn cường độ/sử dụng, điều chỉnh để tối ưu khối lượng vật liệu.',
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
