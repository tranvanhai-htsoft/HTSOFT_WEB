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
    ['type' => 'image', 'src' => '/images/PDF_BAN/BANXIEN_BTC_1.jpg', 'caption' => 'Bố trí chung cống bản xiên, dầm bản đúc sẵn theo định hình 69-34X'],
    ['type' => 'image', 'src' => '/images/PDF_BAN/BANXIEN_THEPDAN_1.jpg', 'caption' => 'Cốt thép dầm bản'],
    ['type' => 'image', 'src' => '/images/PDF_BAN/BANNOI_BTC_1.jpg', 'caption' => 'Bố trí chung cống nối đường nâng cấp cải tạo, dầm bản đổ tại chỗ theo định hình 69-34X'],
    ['type' => 'image', 'src' => '/images/PDF_BAN/BANNOI_THEPBAN_1.jpg', 'caption' => 'Cốt thép phân đoạn dầm nối'],
    ['type' => 'image', 'src' => '/images/PDF_BAN/BAN533_BTC_1.jpg', 'caption' => 'Bố trí chung cầu bản hai nhịp, dầm bản đúc sẵn theo định hình 533-11-01'],
    ['type' => 'image', 'src' => '/images/PDF_BAN/BAN533_THEPDAM_1.jpg', 'caption' => 'Cốt thép dầm bản'],
    ['type' => 'image', 'src' => '/images/PDF_BAN/BANKHOLON_BTC_1.jpg', 'caption' => 'Bố trí chung cầu bản một nhịp, dầm bản đổ tại chỗ, tải trọng 0.65HL93'],
    ['type' => 'image', 'src' => '/images/PDF_BAN/BANKHOLON_THEPXAMU_1.jpg', 'caption' => 'Cốt thép xà mũ mố'],
    ['type' => 'image', 'src' => '/images/PDF_BAN/BANTRAN_BTC_1.jpg', 'caption' => 'Bố trí chung tràn liên hợp cầu bản'],
    ['type' => 'image', 'src' => '/images/PDF_BAN/BANTRAN_DAUCAU_1.jpg', 'caption' => 'Cắt ngang gia cố đường đầu cầu'],
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
    <div class="card-grid" style="grid-template-columns: repeat(2, 1fr);">
        <?php foreach ($gallery as $item): ?>
        <div class="card-3d card-3d--gallery<?= $item['type'] === 'pdf' ? ' card-3d--gallery-full' : '' ?>">
            <div class="gallery-media">
                <?php if ($item['type'] === 'pdf'): ?>
                    <?php
                        // Google Docs Viewer cần URL PDF đầy đủ kèm tên miền — chỉ hoạt động
                        // khi site đã public trên internet (KHÔNG chạy được với localhost, vì
                        // máy chủ Google không truy cập được vào localhost của máy mình).
                        $pdfProtocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || ($_SERVER['SERVER_PORT'] ?? '') == 443) ? 'https://' : 'http://';
                        $fullPdfUrl = $pdfProtocol . $_SERVER['HTTP_HOST'] . $item['src'];
                        $googleViewerUrl = 'https://docs.google.com/viewer?url=' . urlencode($fullPdfUrl) . '&embedded=true';
                    ?>
                    <iframe src="<?= htmlspecialchars($googleViewerUrl) ?>" title="<?= htmlspecialchars($item['caption']) ?>">
                        <!-- Dự phòng cấp 2: chỉ hiện khi trình duyệt không hỗ trợ iframe -->
                        <object data="<?= htmlspecialchars($item['src']) ?>#view=Fit" type="application/pdf" style="width: 100%; height: 100%;">
                            <div style="padding: 20px; text-align: center; font-size: 0.85rem;">
                                <p style="margin-bottom: 10px; color: var(--text-muted);">Trình duyệt không hỗ trợ xem trực tiếp.</p>
                                <a href="<?= htmlspecialchars($item['src']) ?>" download style="display: inline-block; background: #0284c7; color: #fff; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-weight: bold;">Tải file PDF bản vẽ</a>
                            </div>
                        </object>
                    </iframe>
                <?php elseif ($item['type'] === 'image'): ?>
                    <img src="<?= htmlspecialchars($item['src']) ?>" alt="<?= htmlspecialchars($item['caption']) ?>">
                <?php else: ?>
                    <div class="gallery-media__placeholder">Ảnh chưa cập nhật</div>
                <?php endif; ?>
            </div>
            <div class="gallery-note">
                <?php if (!empty($item['caption'])): ?>
                <p class="card-3d__desc"><?= htmlspecialchars($item['caption']) ?></p>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <style>
        /* Chiều cao thẻ = chiều cao khung hiển thị + chiều cao dòng ghi chú (không ép
           tổng chiều cao cố định). Khung hiển thị theo đúng tỉ lệ tờ A3 nằm ngang
           (420 x 297mm); PDF dùng #view=Fit ở src để tự fit vừa khung. */
        .card-3d--gallery { padding: 0; overflow: hidden; display: flex; flex-direction: column; }
        .card-3d--gallery-full { grid-column: span 2; }
        .gallery-media { width: 100%; aspect-ratio: 420 / 297; overflow: hidden; background: #fff; flex-shrink: 0; }
        .gallery-media iframe { width: 100%; height: 100%; border: none; display: block; }
        .gallery-media img { width: 100%; height: 100%; border: none; display: block; object-fit: contain; background: #fff; }
        .gallery-media__placeholder {
            width: 100%; height: 100%; background: var(--bg-color); border: 2px dashed var(--ink);
            display: flex; align-items: center; justify-content: center; color: var(--text-muted); font-size: 0.85rem;
        }
        .gallery-note {
            display: flex; align-items: center; justify-content: center;
            padding: 10px 16px; border-top: 1px solid rgba(0, 0, 0, 0.12);
        }
        .gallery-note .card-3d__desc { margin: 0; }
    </style>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
