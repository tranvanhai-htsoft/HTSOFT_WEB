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
    ['type' => 'image', 'src' => '/images/PDF_DUCSAN/DUCSAN_COBAN_1.jpg', 'caption' => 'Cống vuông đúc sẵn cơ bản với đầu cống sân gia cố thượng hạ lưu'],
    ['type' => 'image', 'src' => '/images/PDF_DUCSAN/DUCSAN_COBAN.jpg', 'caption' => 'Phối cảnh 3D cống vuông đúc sẵn cơ bản'],
    ['type' => 'image', 'src' => '/images/PDF_DUCSAN/DUCSAN_HAIDOC_1.jpg', 'caption' => 'Cống đúc sẵn hai dốc đường miền núi'],
    ['type' => 'image', 'src' => '/images/PDF_DUCSAN/DUCSAN_HAIDOC.jpg', 'caption' => 'Phối cảnh 3D cống hai dốc'],
    ['type' => 'image', 'src' => '/images/PDF_DUCSAN/DUCSAN_RANHCO_1.jpg', 'caption' => 'Cống đúc sẵn kết hợp rãnh cơ tường chắn'],
    ['type' => 'image', 'src' => '/images/PDF_DUCSAN/DUCSAN_RANHCO.jpg', 'caption' => 'Phối cảnh 3D cống kết hợp rãnh cơ tường chắn'],
    ['type' => 'image', 'src' => '/images/PDF_DUCSAN/DUCSAN_DOTHI_1.jpg', 'caption' => 'Cống đúc sẵn đô thị có hố ga đấu nối cống dọc'],
    ['type' => 'image', 'src' => '/images/PDF_DUCSAN/DUCSAN_DOTHI.jpg', 'caption' => 'Phối cảnh 3D cống đô thị hố ga'],
    ['type' => 'image', 'src' => '/images/PDF_DUCSAN/DUCSAN_CONGNOI_1.jpg', 'caption' => 'Cống nối đường nâng cấp cải tạo'],
    ['type' => 'image', 'src' => '/images/PDF_DUCSAN/DUCSAN_CONGNOI.jpg', 'caption' => 'Phối cảnh 3D cống nối'],
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
