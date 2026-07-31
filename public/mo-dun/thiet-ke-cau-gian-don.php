<?php
$pageTitle = 'Phần Mềm Thiết Kế Cầu Giản Đơn';
$pageDescription = 'Tự động thiết kế bản vẽ bố trí chung, bố trí cốt thép mố trụ, cọc móng và bóc tách khối lượng chính xác 100%.';

$features = [
    'Tự động thiết kế bản vẽ Bố trí chung (General Arrangement)' => 'Dựa trên các thông số đầu vào về địa hình, khổ thông thuyền và trắc dọc tuyến, phần mềm tự động tính toán, tối ưu hóa chiều dài nhịp, chiều cao dầm và xuất bản vẽ bố trí chung toàn cầu chuẩn xác, trực quan.',
    'Tự động bố trí cốt thép Mố, Trụ cầu' => 'Không còn mất hàng tuần để vẽ cốt thép thủ công. Phần mềm tích hợp các modul thông minh, tự động tính toán diện tích cốt thép yêu cầu theo TCVN 11823 và tự động rải thép, dựng chi tiết cốt thép cho thân mố/trụ, xà mũ, tường tai, bệ móng... theo đúng cấu tạo tiêu chuẩn.',
    'Thiết kế chi tiết các loại cọc' => 'Hỗ trợ mô hình hóa và triển khai bản vẽ chi tiết cho đa dạng giải pháp móng: từ cọc đặc, cọc đóng (cọc vuông bê tông cốt thép) cho đến hệ thống cọc khoan nhồi đường kính lớn. Tự động xuất cao độ mũi cọc, cấu tạo các đoạn cọc và chi tiết nối cọc.',
    'Bóc tách khối lượng tự động (Quantity Takeoff)' => 'Ngay sau khi thiết kế xong, phần mềm sẽ tự động thống kê, lập bảng thống kê cốt thép (bar bending schedule) và bóc tách chính xác 100% khối lượng bê tông, ván khuôn, cốt thép, cáp dự ứng lực, gối cầu, khe co giãn... Giảm thiểu hoàn toàn sai sót khi làm dự toán.',
];

$gallery = [
    'Bản vẽ bố trí chung tự động xuất',
    'Chi tiết cốt thép mố, trụ cầu',
    'Bảng thống kê khối lượng tự động',
];

require __DIR__ . '/../includes/header.php';
?>

<section>
    <h1 style="margin: 8px 0 10px; font-size: 1.9rem;"><?= htmlspecialchars($pageTitle) ?></h1>
    <p style="color: var(--text-muted); max-width: 60ch; margin-bottom: 40px;">
        <?= htmlspecialchars($pageDescription) ?>
    </p>
</section>

<section>
    <h2 style="margin: 8px 0 20px; font-size: 1.4rem;">Tính năng cốt lõi</h2>
    <ul class="feature-list">
        <?php foreach ($features as $label => $desc): ?>
        <li><span class="tick-3d">&#10003;</span> <strong><?= htmlspecialchars($label) ?>:</strong>&nbsp;<?= htmlspecialchars($desc) ?></li>
        <?php endforeach; ?>
    </ul>
</section>

<section>
    <h2 style="margin: 8px 0 20px; font-size: 1.4rem;">Hình ảnh sản phẩm</h2>
    <div class="card-grid" style="grid-template-columns: repeat(3, 1fr);">
        <?php foreach ($gallery as $caption): ?>
        <div class="card-3d" style="align-items: center; text-align: center;">
            <div style="width: 100%; aspect-ratio: 4 / 3; background: var(--bg-color); border: 2px dashed var(--ink); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: var(--text-muted); font-size: 0.85rem;">
                Ảnh chưa cập nhật
            </div>
            <p class="card-3d__desc"><?= htmlspecialchars($caption) ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<section>
    <h2 style="margin: 8px 0 20px; font-size: 1.4rem;">Video giới thiệu ngắn</h2>
    <div class="card-3d" style="align-items: center; text-align: center; max-width: 560px; margin: 0 auto;">
        <div style="width: 100%; aspect-ratio: 16 / 9; background: var(--ink); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 0.9rem;">
            Video 30s–1 phút chưa cập nhật
        </div>
        <a href="/bao-gia.php?mo-dun=thiet-ke-cau-gian-don" class="btn-3d btn-3d-red">Tính báo giá mô-đun này ngay</a>
    </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
