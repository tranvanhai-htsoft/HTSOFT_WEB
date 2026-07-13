<?php
$pageTitle = 'Hướng dẫn — Cống Tròn & Cống Hộp Đúc Sẵn';
$pageDescription = 'Các bước sử dụng mô-đun Cống Tròn & Cống Hộp Đúc Sẵn 2026.';

// TODO(SV1): thay nội dung placeholder bằng video/GIF hướng dẫn thật cho từng bước.
$steps = [
    [
        'title' => 'Bước 1: Chọn loại cống và nhập thông số công trình',
        'desc' => 'Chọn cống tròn hoặc cống hộp đúc sẵn phù hợp, nhập độ dốc, tải trọng và điều kiện địa hình — kể cả công trình miền núi có độ dốc lớn, gia cố hạ lưu phức tạp.',
    ],
    [
        'title' => 'Bước 2: Kiểm tra bẻ góc và giải pháp hố ga đi kèm',
        'desc' => 'Xem lại kết quả tự động tính toán bẻ góc bản vẽ hệ thống cống xiên theo tim tuyến, đối chiếu giải pháp cống đô thị tích hợp hố ga thu nước.',
    ],
    [
        'title' => 'Bước 3: Xuất bản vẽ và hồ sơ kỹ thuật',
        'desc' => 'Xuất bản vẽ hoàn chỉnh, dùng được cho công trình mới hoặc nâng cấp cống nối dài theo cao độ đứt cũ.',
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
