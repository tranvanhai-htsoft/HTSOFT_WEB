<?php
$pageTitle = 'Hướng dẫn — Cống Hộp Đổ Tại Chỗ';
$pageDescription = 'Các bước sử dụng mô-đun Cống Hộp Đổ Tại Chỗ 2026.';

// Bạn chỉ cần đổi tên file (ví dụ: buoc-2.mp4, buoc-3.mp4...) thành tên video thật của bạn là chạy ngon lành!
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
        Làm theo các bước dưới đây. Bấm vào từng bước để xem chi tiết.
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
                
                <div class="guide-step__video">
                    <?php if (!empty($step['video_url'])): ?>
                        <!-- Đã sửa: Chỉ giữ lại một thẻ video chuẩn có kèm preload="auto" -->
                        <video controls preload="auto" width="100%" style="border-radius: 8px; max-height: 450px; background: #000; display: block; margin-top: 12px;">
                            <source src="<?= htmlspecialchars($step['video_url']) ?>" type="video/mp4">
                            Trình duyệt của bạn không hỗ trợ phát video này.
                        </video>
                    <?php else: ?>
                        <div style="padding: 20px; background: #f9f9f9; border: 1px dashed #ddd; border-radius: 8px; text-align: center; color: #888; font-style: italic; margin-top: 12px;">
                            Video hướng dẫn đang được cập nhật...
                        </div>
                    <?php endif; ?>
                </div>
                Z
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>