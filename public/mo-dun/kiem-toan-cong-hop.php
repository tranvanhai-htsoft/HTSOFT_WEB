<?php
$pageTitle = 'Phần Mềm Kiểm Toán Cống Hộp';
$pageDescription = 'Tự động tính nội lực khung kín và kiểm toán kết cấu cống hộp, tối ưu khối lượng vật liệu.';

$features = [
    'Tự động tổ hợp tải trọng phức tạp' => 'Tự động tính toán và áp dụng các loại tải trọng đặc thù tác động lên cống hộp bao gồm: áp lực đất (thẳng đứng, chủ động, bị động), áp lực nước (trong và ngoài cống), tĩnh tải bản thân, và hoạt tải xe trên mặt đường theo đúng tiêu chuẩn hiện hành.',
    'Tính toán nội lực hệ khung kín' => 'Tự động phân tích nội lực (mô-men, lực cắt, lực dọc) cho sơ đồ kết cấu khung kín (cống đơn, cống đôi, hoặc cống nhiều vách ngăn). Xuất biểu đồ nội lực trực quan tại mọi vị trí thành bên, bản nắp và bản đáy.',
    'Kiểm toán toàn diện kết cấu cống hộp' => 'Tự động tính toán diện tích cốt thép yêu cầu, kiểm toán khả năng chịu lực của bê tông cốt thép, kiểm tra điều kiện chống nứt, độ võng và các trạng thái giới hạn (TTGH sử dụng, TTGH cường độ) giúp tối ưu hóa khối lượng vật liệu.',
];

$gallery = [
    ['type' => 'image', 'solo' => true, 'src' => '/images/KIEMTOAN_HOP/Kiemtoan_conghop.jpg', 'caption' => 'Sơ đồ tải trọng tác dụng lên cống hộp hai khoang'],
    ['type' => 'image', 'src' => '/images/KIEMTOAN_HOP/CUONGDO1_APLUCMAX.jpg', 'caption' => 'Biểu đồ mô men ứng với tổ hợp tải trọng cường độ 1, khi áp lực ngang lớn nhất'],
    ['type' => 'image', 'src' => '/images/KIEMTOAN_HOP/CUONGDO1_APLUCMIN.jpg', 'caption' => 'Biểu đồ mô men ứng với tổ hợp tải trọng cường độ 1, khi áp lực ngang nhỏ nhất'],
    ['type' => 'image', 'src' => '/images/KIEMTOAN_HOP/SUDUNG1_APLUCMAX.jpg', 'caption' => 'Biểu đồ mô men ứng với tổ hợp tải trọng sử dụng 1, khi áp lực ngang lớn nhất'],
    ['type' => 'image', 'src' => '/images/KIEMTOAN_HOP/SUDUNG1_APLUCMIN.jpg', 'caption' => 'Biểu đồ mô men ứng với tổ hợp tải trọng sử dụng 1, khi áp lực ngang nhỏ nhất'],
    ['type' => 'image', 'src' => '/images/KIEMTOAN_HOP/CUONGDO1_APLUCMAX_Q.jpg', 'caption' => 'Biểu đồ lực cắt ứng với tổ hợp tải trọng cường độ 1, khi áp lực ngang lớn nhất'],
    ['type' => 'image', 'src' => '/images/KIEMTOAN_HOP/CUONGDO1_APLUCMIN_Q.jpg', 'caption' => 'Biểu đồ lực cắt ứng với tổ hợp tải trọng cường độ 1, khi áp lực ngang nhỏ nhất'],
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
        <div class="card-3d card-3d--gallery<?= !empty($item['solo']) ? ' card-3d--gallery-solo' : (($item['type'] === 'pdf') ? ' card-3d--gallery-full' : '') ?>">
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
        .card-3d--gallery-solo { grid-column: span 2; width: 50%; margin: 0 auto; }
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
        @media (max-width: 700px) {
            .card-3d--gallery-solo { width: 100%; }
        }
    </style>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
