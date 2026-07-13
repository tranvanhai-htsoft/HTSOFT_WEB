<?php
$pageTitle = 'Trang chủ';
$pageDescription = 'Dradnet — phần mềm thiết kế cống tự động: cống tròn, cống hộp, cầu bản, hố ga.';

$modules = [
    [
        'icon' => '🔵',
        'title' => 'Mô-đun 1: Cống Tròn & Cống Hộp Đúc Sẵn 2026',
        'desc' => 'Thiết kế nhanh cống tròn, cống hộp đúc sẵn, tự động tính bẻ góc và tích hợp giải pháp cống đô thị.',
        'href' => '/mo-dun/cong-tron-cong-hop-duc-san.php',
    ],
    [
        'icon' => '📦',
        'title' => 'Mô-đun 2: Cống Hộp Đổ Tại Chỗ 2026',
        'desc' => 'Thiết kế kết cấu cống hộp đổ tại chỗ, tường cánh BTCT, tự động dựng và xuất bản vẽ phối cảnh 3D.',
        'href' => '/mo-dun/cong-hop-do-tai-cho.php',
    ],
    [
        'icon' => '🌉',
        'title' => 'Mô-đun 3: Cầu Bản – Cống Bản – Tràn Liên Hợp 2026',
        'desc' => 'Tự động hoá thiết kế cầu bản nhiều nhịp, cống bản lắp ghép và hệ thống tràn liên hợp thoát lũ.',
        'href' => '/mo-dun/cau-ban-cong-ban-tran-lien-hop.php',
    ],
    [
        'icon' => '🕳️',
        'title' => 'Mô-đun 4: Thiết Kế Hố Ga 2026',
        'desc' => 'Thư viện mẫu hố ga đa dạng, thiết kế mạng lưới thoát nước và xuất khối lượng tự động.',
        'href' => '/mo-dun/thiet-ke-ho-ga.php',
    ],
];

require __DIR__ . '/includes/header.php';
?>

<section>
    <span class="eyebrow">Danh mục phần mềm</span>
    <h1 style="margin: 8px 0 30px; font-size: 1.9rem;">Danh Mục Các Mô-đun Phần Mềm</h1>

    <div class="card-grid">
        <?php foreach ($modules as $m): ?>
        <a href="<?= htmlspecialchars($m['href']) ?>" class="card-3d">
            <div class="card-3d__icon"><?= $m['icon'] ?></div>
            <div class="card-3d__title"><?= htmlspecialchars($m['title']) ?></div>
            <p class="card-3d__desc"><?= htmlspecialchars($m['desc']) ?></p>
            <span class="btn-3d btn-3d-yellow">Xem chi tiết ➔</span>
        </a>
        <?php endforeach; ?>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
