<?php
$pageTitle = 'Trang chủ';
$pageDescription = 'Dradnet — phần mềm thiết kế và kiểm toán hạ tầng giao thông: cống, cầu bản, hố ga, cầu giản đơn, cống hộp.';

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
    [
        'icon' => '🏗️',
        'title' => 'Phần Mềm Thiết Kế Cầu Giản Đơn',
        'desc' => 'Tự động thiết kế bản vẽ bố trí chung, bố trí cốt thép mố trụ, cọc móng và bóc tách khối lượng chính xác 100%.',
        'href' => '/mo-dun/thiet-ke-cau-gian-don.php',
    ],
    [
        'icon' => '📐',
        'title' => 'Phần Mềm Kiểm Toán Cầu Giản Đơn',
        'desc' => 'Tự động tổ hợp tải trọng, xếp xe HL-93 và kiểm toán toàn diện dầm cầu theo TCVN 11823.',
        'href' => '/mo-dun/kiem-toan-cau-gian-don.php',
    ],
    [
        'icon' => '🧮',
        'title' => 'Phần Mềm Kiểm Toán Cầu Bản',
        'desc' => 'Tự động tính nội lực và kiểm toán kết cấu dầm bản theo TCVN 11823, AASHTO LRFD.',
        'href' => '/mo-dun/kiem-toan-cau-ban.php',
    ],
    [
        'icon' => '🔲',
        'title' => 'Phần Mềm Kiểm Toán Cống Hộp',
        'desc' => 'Tự động tính nội lực khung kín và kiểm toán kết cấu cống hộp, tối ưu khối lượng vật liệu.',
        'href' => '/mo-dun/kiem-toan-cong-hop.php',
    ],
];

require __DIR__ . '/includes/header.php';
?>

<section>
    <span class="eyebrow">Danh mục phần mềm</span>
    <h1 style="margin: 8px 0 30px; font-size: 1.9rem;">Danh Mục Các Mô-đun Phần Mềm</h1>

    <div class="card-grid">
        <?php foreach ($modules as $m): ?>
        <?php $slug = basename($m['href'], '.php'); ?>
        <div class="card-3d" data-href="<?= htmlspecialchars($m['href']) ?>">
            <div class="card-3d__icon"><?= $m['icon'] ?></div>
            <div class="card-3d__title"><?= htmlspecialchars($m['title']) ?></div>
            <p class="card-3d__desc"><?= htmlspecialchars($m['desc']) ?></p>
            <div class="card-3d__actions">
                <a href="<?= htmlspecialchars($m['href']) ?>" class="btn-3d btn-3d-yellow">Xem chi tiết ➔</a>
                <div class="card-3d__actions-secondary">
                    <a href="/huong-dan/<?= htmlspecialchars($slug) ?>.php" class="btn-3d btn-3d-blue">Hướng dẫn</a>
                    <button type="button" class="btn-3d btn-3d-select" data-module="<?= htmlspecialchars($slug) ?>" aria-pressed="false">Chọn mua</button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
