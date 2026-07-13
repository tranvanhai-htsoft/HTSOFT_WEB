<?php
$pageTitle = 'Hướng dẫn — Cống Hộp Đổ Tại Chỗ';
$pageDescription = 'Các bước sử dụng mô-đun Cống Hộp Đổ Tại Chỗ 2026.';

// TODO(SV1): thay nội dung placeholder bằng video/GIF hướng dẫn thật cho từng bước.
$steps = [
    [
        'title' => 'Bước 1: Chọn mẫu bố trí cốt thép tiêu chuẩn',
        'desc' => 'Chọn mẫu cốt thép theo thư viện chuẩn quốc gia, nhập thông số kết cấu tường cánh bê tông và bê tông cốt thép (BTCT).',
    ],
    [
        'title' => 'Bước 2: Xử lý các trường hợp kết cấu đặc biệt',
        'desc' => 'Với cống xiên, cống nối dài, hầm chui dân sinh hoặc mô hình cống kết hợp kênh mương thủy lợi, điều chỉnh thông số theo hướng dẫn trong phần mềm.',
    ],
    [
        'title' => 'Bước 3: Xem phối cảnh 3D và xuất bản vẽ',
        'desc' => 'Xem trước bản vẽ phối cảnh 3D tự động dựng, sau đó xuất trọn bộ hồ sơ thiết kế.',
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
