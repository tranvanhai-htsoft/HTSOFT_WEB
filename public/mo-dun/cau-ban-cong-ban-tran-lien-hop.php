<?php
require __DIR__ . '/../includes/config.php';

$pageTitle = 'Mô-đun 3: Cầu Bản – Cống Bản – Tràn Liên Hợp ' . MODULE_YEAR;
$pageDescription = 'Tự động hoá thiết kế cầu bản nhiều nhịp, cống bản lắp ghép và hệ thống tràn liên hợp thoát lũ.';

$features = [
    'Tự động hóa hoàn toàn' => 'Tự động hóa quy trình thiết kế kết cấu công trình cầu bản nhiều nhịp liên tục.',
    'Mô hình phức hợp' => 'Giải pháp tối ưu cho hệ thống cầu bản kết hợp đường tràn thoát lũ.',
    'Tính toán lắp ghép' => 'Hỗ trợ tính toán cống bản dầm lắp ghép định hình hoặc hệ dầm đổ tại chỗ linh hoạt.',
    'Nâng cấp tuyến đường' => 'Mô hình thông minh chuyên xử lý cống bản nối dài, phục vụ các dự án cải tạo, nâng cấp.',
];

$gallery = [
    'Kết cấu cầu bản nhiều nhịp liên tục',
    'Hệ thống tràn liên hợp thoát lũ',
    'Cống bản dầm lắp ghép định hình',
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
        <a href="/bao-gia.php?mo-dun=cau-ban-cong-ban-tran-lien-hop" class="btn-3d btn-3d-red">Tính báo giá mô-đun này ngay</a>
    </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
