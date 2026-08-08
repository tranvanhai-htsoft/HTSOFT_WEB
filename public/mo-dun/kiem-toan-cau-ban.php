<?php
$pageTitle = 'Phần Mềm Kiểm Toán Cầu Bản';
$pageDescription = 'Tự động tính nội lực và kiểm toán kết cấu dầm bản theo TCVN 11823, AASHTO LRFD.';

$features = [
    'Tự động tổ hợp tải trọng' => 'Tự động xác định, phân bổ và tổ hợp các loại tải trọng (tĩnh tải, hoạt tải xe, tác động môi trường...) theo đúng các tiêu chuẩn thiết kế hiện hành (TCVN 11823, AASHTO LRFD), loại bỏ hoàn toàn việc tính toán thủ công phức tạp.',
    'Tính toán nội lực chính xác' => 'Tích hợp lõi xử lý mạnh mẽ, tự động phân tích và xuất biểu đồ nội lực (mô-men, lực cắt) tại các mặt cắt nguy hiểm một cách trực quan và nhanh chóng.',
    'Kiểm toán toàn diện kết cấu dầm bản' => 'Hỗ trợ đa dạng các loại dầm bản (bản đặc, bản rỗng, bản bê tông cốt thép thường hoặc bê tông dự ứng lực). Tự động kiểm tra các điều kiện bền, điều kiện sử dụng (nứt, độ võng) và độ mỏi của kết cấu.',
];

$gallery = [
    ['type' => 'image', 'src' => '/images/KIEMTOAN_CAUBAN/SODOTAI_DAM.jpg', 'caption' => 'Sơ đồ chất tải dầm bản'],
    ['type' => 'image', 'src' => '/images/KIEMTOAN_CAUBAN/SODOTAI_MO.jpg', 'caption' => 'Sơ đồ chất tải mố cầu'],
    ['type' => 'image', 'src' => '/images/KIEMTOAN_CAUBAN/MOMEN_CD1.jpg', 'caption' => 'Biểu đồ mô men ứng với tổ hợp tải trọng cường độ'],
    ['type' => 'image', 'src' => '/images/KIEMTOAN_CAUBAN/MOMEN_SD1.jpg', 'caption' => 'Biểu đồ mô men ứng với tổ hợp tải trọng sử dụng'],
    ['type' => 'image', 'src' => '/images/KIEMTOAN_CAUBAN/LUCCAT_CD1.jpg', 'caption' => 'Biểu đồ lực cắt ứng với tổ hợp tải trọng cường độ'],
    ['type' => 'image', 'src' => '/images/KIEMTOAN_CAUBAN/LUCCAT_SD1.jpg', 'caption' => 'Biểu đồ lực cắt ứng với tổ hợp tải trọng sử dụng'],
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
