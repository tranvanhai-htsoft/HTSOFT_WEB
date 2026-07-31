<?php
require __DIR__ . '/includes/session.php';

if ($currentUserId === null) {
    header('Location: /dang-nhap.php');
    exit;
}

$downloads = require dirname(__DIR__) . '/src/config/downloads.php';
$downloadsDir = dirname(__DIR__) . '/storage/downloads/';

$pageTitle = 'Tải phần mềm';
$pageDescription = 'Tải file cài đặt cho từng mô-đun phần mềm.';
require __DIR__ . '/includes/header.php';
?>

<section>
    <h1 style="margin: 8px 0 8px; font-size: 1.9rem;">Tải Phần Mềm</h1>
    <p class="card-3d__desc" style="max-width: 640px; margin-bottom: 28px;">
        Mô-đun 1–5 có 2 bản cài đặt riêng theo phiên bản AutoCAD. Mô-đun 6–8 chỉ có 1 bản cài đặt chung.
    </p>

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; font-size: 0.92rem;">
            <thead>
                <tr style="text-align: left; border-bottom: 2px solid var(--ink);">
                    <th style="padding: 10px 8px;">Mô-đun</th>
                    <th style="padding: 10px 8px;">Phiên bản</th>
                    <th style="padding: 10px 8px;">File cài đặt</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($downloads as $slug => $mod): ?>
                <?php foreach ($mod['variants'] as $variantKey => $variant): ?>
                <?php $fileExists = is_file($downloadsDir . $variant['file']); ?>
                <tr style="border-bottom: 1px solid rgba(0,0,0,0.1);">
                    <td style="padding: 10px 8px;"><?= htmlspecialchars($mod['name']) ?></td>
                    <td style="padding: 10px 8px;"><?= htmlspecialchars($variant['label']) ?></td>
                    <td style="padding: 10px 8px;">
                        <?php if ($fileExists): ?>
                        <a href="/tai-file.php?slug=<?= urlencode($slug) ?>&variant=<?= urlencode($variantKey) ?>" class="btn-3d btn-3d-blue">Tải xuống</a>
                        <?php else: ?>
                        <span style="opacity: 0.6;">Chưa có file — liên hệ hỗ trợ</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
