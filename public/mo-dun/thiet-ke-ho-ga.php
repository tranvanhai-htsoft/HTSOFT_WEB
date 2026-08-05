<?php
$pageTitle = 'Mô-đun 04: Thiết Kế Hố Ga';
$pageDescription = 'Thư viện mẫu hố ga đa dạng, thiết kế mạng lưới thoát nước và xuất khối lượng tự động.';

$features = [
    'Thư viện mẫu đa dạng' => 'Tích hợp chức năng thiết kế hàng chục mẫu hố ga thông dụng của các địa phương trên cả nước như ga thăm, ga thu thăm, ga vỉa hè, lòng đường, ga nước mưa và nước thải.',
    'Đấu nối linh hoạt' => 'Cho phép đấu nối trực tiếp hoặc xây dựng đấu nối thông qua Excel với hệ thống cống tròn, cống hộp và mương thoát nước.',
    'Hiệu chỉnh tham số tự động' => 'Cho phép gán đồng thời tham số cho hàng loạt ga, hỗ trợ lưu và tải mẫu các loại ga một cách nhanh chóng và linh hoạt.',
    'Mẫu ga chuyên dụng' => 'Thiết kế ga bán lắp ghép, ga sân bay, đấu nối cống hộp khổ lớn.',
    'Bố trí cốt thép' => 'Tùy chọn linh hoạt bố trí một lưới thép thân ga hoặc hai lưới thép theo yêu cầu chịu lực.',
    'Xuất khối lượng chi tiết' => 'Xuất khối lượng hàng loạt ga qua Excel; tự động phân tách mỗi ga một sheet kèm công thức diễn giải và bảng tổng hợp chung ở sheet cuối cùng.',
];

$gallery = [
    ['type' => 'image', 'src' => '/images/PDF_GA/GATHUTHAM_HANOI_1.jpg', 'caption' => 'Ga thu thăm bê tông cốt thép mẫu Hà Nội 1'],
    ['type' => 'image', 'src' => '/images/PDF_GA/GATHUTHAM_HANOI.jpg', 'caption' => 'Phối cảnh 3D ga thu thăm Hà Nội 1'],
    ['type' => 'image', 'src' => '/images/PDF_GA/GATHUTHAM_HANOI2_1.jpg', 'caption' => 'Ga thu thăm bê tông cốt thép mẫu Hà Nội 2'],
    ['type' => 'image', 'src' => '/images/PDF_GA/GATHUTHAM_HANOI2.jpg', 'caption' => 'Phối cảnh 3D ga thu thăm Hà Nội 2'],
    ['type' => 'image', 'src' => '/images/PDF_GA/GATHUTHAM_PHUTHO_1.jpg', 'caption' => 'Ga thu thăm gạch xây mẫu Phú Thọ'],
    ['type' => 'image', 'src' => '/images/PDF_GA/GATHUTHAM_PHUTHO.jpg', 'caption' => 'Phối cảnh 3D ga thu thăm Phú Thọ'],
    ['type' => 'image', 'src' => '/images/PDF_GA/GATHUTHAM_PHUYEN_1.jpg', 'caption' => 'Ga thu thăm bê tông cốt thép mẫu Phú Yên'],
    ['type' => 'image', 'src' => '/images/PDF_GA/GATHUTHAM_PHUYEN.jpg', 'caption' => 'Phối cảnh 3D ga thu thăm Phú Yên'],
    ['type' => 'image', 'src' => '/images/PDF_GA/GATHUTHAM_KHANHHOA_1.jpg', 'caption' => 'Ga thu thăm bê tông cốt thép mẫu Khánh Hoà'],
    ['type' => 'image', 'src' => '/images/PDF_GA/GATHUTHAM_KHANHHOA.jpg', 'caption' => 'Phối cảnh 3D ga thu thăm Khánh Hoà'],
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
