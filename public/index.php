<?php
require __DIR__ . '/includes/config.php';

$pageTitle = 'Trang chủ';
$pageDescription = 'Dradnet — phần mềm thiết kế và kiểm toán hạ tầng giao thông: cống, cầu bản, hố ga, cầu giản đơn, cống hộp.';

$modules = [
    [
        'icon' => '🔵',
        'image' => 'images/Index/Index_Modun1_Ongcong.jpg',
        'title' => 'Mô-đun 1: Cống Tròn & Cống Hộp Đúc Sẵn ' . MODULE_YEAR,
        'desc' => 'Thiết kế nhanh cống tròn, cống hộp đúc sẵn, tự động tính bẻ góc và tích hợp giải pháp cống đô thị.',
        'href' => '/mo-dun/cong-tron-cong-hop-duc-san.php',
    ],
    [
        'icon' => '🔵',
        'image' => 'images/Index/Index_Modun2_Ongcong.jpg',
        'title' => 'Mô-đun 2: Cống Hộp Đổ Tại Chỗ ' . MODULE_YEAR,
        'desc' => 'Thiết kế kết cấu cống hộp đổ tại chỗ, tường cánh BTCT, tự động dựng và xuất bản vẽ phối cảnh 3D.',
        'href' => '/mo-dun/cong-hop-do-tai-cho.php',
    ],
    [
        'icon' => '🔵',
        'image' => 'images/Index/Index_Modun3_Cauban.jpg',
        'title' => 'Mô-đun 3: Cầu Bản – Cống Bản – Tràn Liên Hợp ' . MODULE_YEAR,
        'desc' => 'Tự động hoá thiết kế cầu bản nhiều nhịp, cống bản lắp ghép và hệ thống tràn liên hợp thoát lũ.',
        'href' => '/mo-dun/cau-ban-cong-ban-tran-lien-hop.php',
    ],
    [
        'icon' => '🔵',
        'image' => 'images/Index/Index_Modun4_Hoga.jpg',
        'title' => 'Mô-đun 4: Thiết Kế Hố Ga ' . MODULE_YEAR,
        'desc' => 'Thư viện mẫu hố ga đa dạng, thiết kế mạng lưới thoát nước và xuất khối lượng tự động.',
        'href' => '/mo-dun/thiet-ke-ho-ga.php',
    ],
    [
        'icon' => '🔵',
        'image' => 'images/Index/index_Modun5_thietke_caugiandon.png',
        'title' => 'Mô-đun 5: Thiết Kế Cầu Giản Đơn BTCT DƯL ' . MODULE_YEAR,
        'desc' => 'Tự động thiết kế bản vẽ bố trí chung, bố trí cốt thép mố trụ, cọc móng và bóc tách khối lượng chính xác 100%.',
        'href' => '/mo-dun/thiet-ke-cau-gian-don.php',
    ],
    [
        'icon' => '🔵',
        'image' => 'images/Index/index_Modun6_Kiemtoan_caugiandon.jpg',
        'title' => 'Mô-đun 6: Kiểm Toán Cầu Giản Đơn ' . MODULE_YEAR,
        'desc' => 'Tự động tổ hợp tải trọng, xếp xe HL-93 và kiểm toán toàn diện dầm cầu theo TCVN 11823.',
        'href' => '/mo-dun/kiem-toan-cau-gian-don.php',
    ],
    [
        'icon' => '🔵',
        'image' => 'images/Index/index_Modun7_Kiemtoan_cauban.jpg',
        'title' => 'Mô-đun 7: Kiểm Toán Cầu Bản ' . MODULE_YEAR,
        'desc' => 'Tự động tính nội lực và kiểm toán kết cấu dầm bản theo TCVN 11823, AASHTO LRFD.',
        'href' => '/mo-dun/kiem-toan-cau-ban.php',
    ],
    [
        'icon' => '🔵',
        'image' => 'images/Index/index_Modun8_Kiemtoan_conghop.jpg',
        'title' => 'Mô-đun 8: Kiểm Toán Cống Hộp ' . MODULE_YEAR,
        'desc' => 'Tự động tính nội lực khung kín và kiểm toán kết cấu cống hộp, tối ưu khối lượng vật liệu.',
        'href' => '/mo-dun/kiem-toan-cong-hop.php',
    ],
];

require __DIR__ . '/includes/header.php';
?>

<section>
    <h1 style="margin: 8px 0 30px; font-size: 1.9rem;">Danh Mục Các Mô-đun Phần Mềm</h1>

    <div class="card-grid">
        <?php foreach ($modules as $m): ?>
        <?php $slug = basename($m['href'], '.php'); ?>
        <div class="card-3d" data-href="<?= htmlspecialchars($m['href']) ?>">
            <?php if (!empty($m['image'])): ?>
                <img src="<?= htmlspecialchars($m['image']) ?>" alt="<?= htmlspecialchars($m['title']) ?>" class="card-3d__icon-img">
            <?php else: ?>
                <div class="card-3d__icon"><?= $m['icon'] ?></div>
            <?php endif; ?>
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

<script>
(function () {
    var STORAGE_KEY = 'druong_selected_modules';

    function getSelected() {
        try { return JSON.parse(localStorage.getItem(STORAGE_KEY)) || []; }
        catch (e) { return []; }
    }
    function setSelected(arr) {
        try { localStorage.setItem(STORAGE_KEY, JSON.stringify(arr)); } catch (e) {}
    }

    function refreshButtons() {
        var selected = getSelected();
        document.querySelectorAll('.btn-3d-select[data-module]').forEach(function (btn) {
            var slug = btn.dataset.module;
            var isSelected = selected.indexOf(slug) !== -1;
            btn.classList.toggle('is-selected', isSelected);
            btn.setAttribute('aria-pressed', isSelected ? 'true' : 'false');
            btn.textContent = isSelected ? 'Đã chọn ✓' : 'Chọn mua';
        });
    }

    document.querySelectorAll('.btn-3d-select[data-module]').forEach(function (btn) {
        var slug = btn.dataset.module;
        btn.addEventListener('click', function () {
            var list = getSelected();
            var idx = list.indexOf(slug);
            if (idx === -1) list.push(slug); else list.splice(idx, 1);
            setSelected(list);
            refreshButtons();
        });
    });

    // Trang bao-gia.php ghi lại localStorage mỗi khi bỏ chọn mô-đun; nếu quay lại
    // trang này qua nút Back của trình duyệt (bfcache), script không chạy lại nên
    // phải refresh thủ công khi trang được khôi phục từ cache.
    window.addEventListener('pageshow', function (e) {
        if (e.persisted) refreshButtons();
    });

    // Đồng bộ khi 2 trang mở ở 2 tab khác nhau cùng lúc.
    window.addEventListener('storage', function (e) {
        if (e.key === STORAGE_KEY) refreshButtons();
    });

    refreshButtons();
})();
</script>

<?php require __DIR__ . '/includes/footer.php'; ?>
