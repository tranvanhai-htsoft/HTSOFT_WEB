<?php
$pageTitle = 'Hướng dẫn — Thiết Kế Hố Ga';
$pageDescription = 'Các bước sử dụng mô-đun Thiết Kế Hố Ga 2026.';

// TODO(SV1): thay nội dung placeholder bằng video/GIF hướng dẫn thật cho từng bước.
$steps = [
    [
        'title' => 'Bước 1: Chọn mẫu hố ga từ thư viện',
        'desc' => 'Chọn mẫu ga thăm, ga thu, ga vỉa hè hoặc ga lòng đường phù hợp với nhu cầu công trình.',
    ],
    [
        'title' => 'Bước 2: Thiết kế mạng lưới và xử lý nút giao',
        'desc' => 'Bố trí mạng lưới ga thu nước mưa và hệ thống ga thoát nước thải riêng biệt, xử lý các nút giao phức tạp như ga kết hợp cống hộp khổ lớn.',
    ],
    [
        'title' => 'Bước 3: Vẽ cốt thép và xuất khối lượng',
        'desc' => 'Vẽ chi tiết cốt thép hàng loạt hố ga, xuất bảng khối lượng kèm diễn giải chi tiết từng cấu kiện.',
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
