<?php
$pageTitle = 'Mô-đun 03: Cầu Bản – Cống Bản – Tràn Liên Hợp';
$pageDescription = 'Tự động hoá thiết kế cầu bản nhiều nhịp, cống bản lắp ghép và hệ thống tràn liên hợp thoát lũ.';

$features = [
    'Hệ thống cống bản' => 'Thiết kế cống bản với dầm bản đúc sẵn hoặc đổ tại chỗ theo định hình 69-34X, mẫu địa phương và cống nối đường nâng cấp.',
    'Cấu trúc cầu bản' => 'Tích hợp đồng bộ phương án dầm đúc sẵn và đổ tại chỗ dựa trên định hình 69-34X và 533-11-01.',
    'Cầu tràn liên hợp' => 'Thiết kế toàn diện cho hệ thống tràn liên hợp cầu bản, đầy đủ mố, trụ, kết cấu gia cố, cọc tiêu và cọc thủy chí.',
    'Cầu bản tải trọng 0.65HL93' => 'Thiết kế cầu dầm bản đổ tại chỗ với chiều dài nhịp lên đến 9m, với mố trụ bê tông cốt thép.',
    'Khối lượng linh hoạt' => 'Xuất tổng hợp khối lượng chi tiết kèm diễn giải toàn tuyến. Hỗ trợ bóc tách và phân chia theo từng gói thầu độc lập.',
];

$gallery = [
    'Kết cấu cầu bản nhiều nhịp liên tục',
    'Hệ thống tràn liên hợp thoát lũ',
    'Cống bản dầm lắp ghép định hình',
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
        <a href="/bao-gia.php?mo-dun=cau-ban-cong-ban-tran-lien-hop" class="btn-3d btn-3d-red">Tính báo giá mô-đun này ngay</a>
    </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
