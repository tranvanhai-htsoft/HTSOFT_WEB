<?php
$pageTitle = 'Mô-đun 02: Cống Hộp Đổ Tại Chỗ';
$pageDescription = 'Thiết kế kết cấu cống hộp đổ tại chỗ, tường cánh BTCT, tự động dựng và xuất bản vẽ phối cảnh 3D.';

$features = [
    'Cốt thép thân cống' => 'Tích hợp đầy đủ các cấu trúc phổ biến như mẫu Tedi, mẫu khung, mẫu móng cọc và mẫu đường cao tốc.',
    'Tường cánh bê tông BTCT' => 'Hỗ trợ đa dạng phương án thiết kế gồm tường cánh vuông góc, song song, kết hợp cống khung, tứ nón và khe phai.',
    'Đường gom liên hoàn' => 'Đồng bộ giải pháp thiết kế cống trên trục đường chính và hai đường gom hai bên đồng thời trên một mặt cắt ngang.',
    'Nâng cấp cải tạo' => 'Kết nối mở rộng cống linh hoạt một phía hoặc cả hai phía đi kèm hệ thống cửa xả tiêu chuẩn.',
    'Cấu trúc cống xiên' => 'Giải quyết tối ưu và chính xác các phương án cống đặt xiên góc theo địa hình thực tế.',
    'Cống chui dân sinh' => 'Hỗ trợ triển khai nhanh hệ thống cống chui đi kèm tường cánh thẳng và tứ nón dọc tuyến.',
    'Khối lượng linh hoạt' => 'Xuất tổng hợp khối lượng chi tiết kèm diễn giải toàn tuyến. Hỗ trợ bóc tách và phân chia theo từng gói thầu độc lập.',
];

$gallery = [
    'Bố trí cốt thép cống hộp tiêu chuẩn',
    'Kết cấu tường cánh BTCT',
    'Bản vẽ phối cảnh 3D tự động',
];

require __DIR__ . '/../includes/header.php';
?>

<section style="text-align: left;">
    <h1 style="margin: 0 0 28px; font-size: 1.9rem; text-align: left;"><?= htmlspecialchars($pageTitle) ?></h1>
</section>

<section>
    <h2 style="margin: 8px 0 20px; font-size: 1.4rem;">Tính năng cốt lõi</h2>
    <ul class="feature-list feature-list--minimal">
        <?php foreach ($features as $label => $desc): ?>
        <li><span class="feature-dot" aria-hidden="true"></span> <strong><?= htmlspecialchars($label) ?></strong> &mdash; <?= htmlspecialchars($desc) ?></li>
        <?php endforeach; ?>
    </ul>
</section>

<style>
    .feature-list--minimal li { align-items: flex-start; }
    .feature-dot {
        flex-shrink: 0;
        display: inline-block;
        width: 6px;
        height: 6px;
        margin-top: 0.55em;
        border-radius: 50%;
        background: var(--text-muted, #888);
    }
</style>

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
        <a href="/bao-gia.php?mo-dun=cong-hop-do-tai-cho" class="btn-3d btn-3d-red">Tính báo giá mô-đun này ngay</a>
    </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
