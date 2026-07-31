<?php
$pageTitle = 'Mô-đun 01: Cống Tròn & Cống Hộp Đúc Sẵn';
$pageDescription = 'Thiết kế nhanh cống tròn, cống hộp đúc sẵn, tự động tính bẻ góc và tích hợp giải pháp cống đô thị.';

$features = [
    'Đầy đủ chủng loại' => 'Tích hợp toàn diện các loại cống tròn, cống hộp, ly tâm, rung ép, rung lõi và rung bàn.',
    'Cống địa hình miền núi' => 'Tối ưu cho công trình có độ dốc lớn, hai dốc, tường chắn, hạ lưu giật cấp hoặc thượng lưu rãnh cơ kết hợp hố thu.',
    'Giải pháp đô thị' => 'Quy hoạch và thiết kế đồng bộ hệ thống thoát nước đi kèm hố ga thu nước tiêu chuẩn.',
    'Cống nối nâng cấp' => 'Hỗ trợ kết nối linh hoạt 1 phía hoặc 2 phía, bao gồm đầy đủ hệ thống cống, hố thu và cửa xả.',
    'Cấu trúc cống xiên' => 'Giải quyết tối ưu và chính xác các phương án cống đặt xiên góc theo địa hình thực tế.',
    'Tổng hợp khối lượng linh hoạt' => 'Xuất THKL chi tiết kèm diễn giải và khối lượng toàn tuyến. Cho phép phân chia khối lượng theo gói thầu.',
];

$gallery = [
    'Giao diện thiết kế cống tròn đúc sẵn',
    'Bố trí cống hộp công trình miền núi',
    'Bản vẽ hệ thống cống xiên tự động bẻ góc',
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
        <a href="/bao-gia.php?mo-dun=cong-tron-cong-hop-duc-san" class="btn-3d btn-3d-red">Tính báo giá mô-đun này ngay</a>
    </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
