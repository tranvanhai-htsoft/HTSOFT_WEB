<?php
$pageTitle = 'Hướng dẫn — Cầu Bản – Cống Bản – Tràn Liên Hợp';
$pageDescription = 'Các bước sử dụng mô-đun Cầu Bản – Cống Bản – Tràn Liên Hợp 2026.';

// TODO(SV1): thay nội dung placeholder bằng video/GIF hướng dẫn thật cho từng bước.
$steps = [
    [
        'title' => 'Bước 1: Thiết lập các tham số phần mềm',
        'desc' => 'Khởi tạo dự án: Vào File > New (hoặc Open) để mở file. Thiết lập tỷ lệ, vật liệu, font chữ, xuất bản vẽ và gia cố taluy.',
    ],
    [
        'title' => 'Bước 2: Quét chọn trắc ngang',
        'desc' => 'Nhận dữ liệu trắc ngang: Quét chọn trắc ngang từ nguồn (Nova, VnRoad, Civil 3D,...). Nhận từ tab trắc ngang và xuất sang tab bản vẽ cống làm cơ sở thiết kế.',
    ],
    [
        'title' => 'Bước 3: Gán thông số thân cống, thiết kế thân cống',
        'desc' => 'Thiết kế thân cống: Chọn loại cống, số dãy. Khai báo thông số hình học tại menu Thân cống. Xem trước, chỉnh số đốt/độ dốc xuất bản vẽ và Lưu khối lượng.',
    ],
    [
        'title' => 'Bước 4: Thiết kế thượng lưu',
        'desc' => 'Thiết kế thượng lưu: Chọn kết cấu phù hợp phía thượng lưu, hiệu chỉnh kích thước hoặc load file mẫu. Xuất bản vẽ, nhấn Lưu khối lượng sau khi hoàn thành.',
    ],
    [
        'title' => 'Bước 5: Thiết kế hạ lưu',
        'desc' => 'Thiết kế hạ lưu: Chọn kết cấu phù hợp phía hạ lưu, hiệu chỉnh kích thước hoặc load file mẫu. Xuất bản vẽ, nhấn Lưu khối lượng sau khi hoàn thành.',
    ],
    [
        'title' => 'Bước 6: Thiết kế móng thân cống',
        'desc' => 'hiết kế móng cống: Thiết lập thông số, vẽ kết cấu móng thân cống phù hợp địa chất. Nhấn Lưu khối lượng.',
    ],
    [
        'title' => 'Bước 7: Xuất khối lượng và thuyết minh cống',
        'desc' => 'Xuất hồ sơ & Thuyết minh: Xuất bảng khối lượng chi tiết và thuyết minh thiết kế phục vụ lập hồ sơ, dự toán.',
    ],
    [
        'title' => 'Bước 8: Vẽ bản quá độ, lan can',
        'desc' => 'Cấu kiện bổ sung (Cống hộp/Cầu bản): Thiết kế và vẽ bản quá độ, lan can, cọc BTCT (chỉ áp dụng cho cống hộp đúc tại chỗ và cầu bản).',
    ],
    [
        'title' => 'Bước 9: Bảng tổng hợp khối lượng cống qua excel',
        'desc' => 'Tổng hợp khối lượng sang Excel: Tự động gom dữ liệu toàn bộ hệ thống cống trong dự án và xuất file Excel để thống kê.',
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
