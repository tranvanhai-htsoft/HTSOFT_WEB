<?php
$pageTitle = 'Hướng dẫn — Cầu Bản – Cống Bản – Tràn Liên Hợp';
$pageDescription = 'Các bước sử dụng mô-đun Cầu Bản – Cống Bản – Tràn Liên Hợp 2026.';

// TODO(SV1): thay nội dung placeholder bằng video/GIF hướng dẫn thật cho từng bước.
$steps = [
    [
        'title' => 'Bước 1: Khai báo kết cấu nhịp và loại công trình',
        'desc' => 'Nhập số nhịp, chọn cầu bản nhiều nhịp liên tục hoặc hệ thống cầu bản kết hợp đường tràn thoát lũ.',
    ],
    [
        'title' => 'Bước 2: Tính toán lắp ghép hoặc đổ tại chỗ',
        'desc' => 'Phần mềm tự động tính cống bản dầm lắp ghép định hình hoặc hệ dầm đổ tại chỗ theo lựa chọn kết cấu.',
    ],
    [
        'title' => 'Bước 3: Xuất hồ sơ cho công trình cải tạo hoặc mới',
        'desc' => 'Xuất bản vẽ hoàn chỉnh, áp dụng được cho cả dự án nâng cấp, cải tạo cống bản nối dài.',
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
