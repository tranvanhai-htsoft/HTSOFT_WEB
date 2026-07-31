<?php
$pageTitle = 'Hướng dẫn — Thiết Kế Cầu Giản Đơn';
$pageDescription = 'Các bước sử dụng Phần Mềm Thiết Kế Cầu Giản Đơn.';

// TODO(SV1): thay nội dung placeholder bằng video/GIF hướng dẫn thật cho từng bước.
$steps = [
    [
        'title' => 'Bước 1: Nhập thông số địa hình và khổ thông thuyền',
        'desc' => 'Nhập trắc dọc tuyến, khổ thông thuyền, phần mềm tự động tối ưu chiều dài nhịp và chiều cao dầm.',
    ],
    [
        'title' => 'Bước 2: Kiểm tra bố trí cốt thép mố, trụ và cọc',
        'desc' => 'Xem lại kết quả tự động rải thép theo TCVN 11823 và cấu tạo cọc móng đã chọn (cọc đặc, cọc đóng, cọc khoan nhồi).',
    ],
    [
        'title' => 'Bước 3: Xuất bản vẽ và bảng khối lượng',
        'desc' => 'Xuất bản vẽ bố trí chung, chi tiết cốt thép và bảng thống kê khối lượng (bar bending schedule) hoàn chỉnh.',
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
