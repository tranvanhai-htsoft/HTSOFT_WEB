<?php
$pageTitle = 'Hướng dẫn sử dụng';
$pageDescription = 'Chọn mô-đun để xem hướng dẫn sử dụng chi tiết theo từng bước.';

// Danh sách phải khớp với $modules trong index.php — mỗi mô-đun có 1 trang hướng dẫn riêng.
$guides = [
    ['image' => 'images/ongcong.png', 'slug' => 'cong-tron-cong-hop-duc-san', 'title' => 'Cống Tròn & Cống Hộp Đúc Sẵn', 'href' => '/huong-dan/cong-tron-cong-hop-duc-san.php'],
    ['image' => 'images/Ongcong2.jpg', 'slug' => 'cong-hop-do-tai-cho', 'title' => 'Cống Hộp Đổ Tại Chỗ', 'href' => '/huong-dan/cong-hop-do-tai-cho.php'],
    ['image' => 'images/Cauban.png', 'slug' => 'cau-ban-cong-ban-tran-lien-hop', 'title' => 'Cầu Bản – Cống Bản – Tràn Liên Hợp', 'href' => '/huong-dan/cau-ban-cong-ban-tran-lien-hop.php'],
    ['image' => 'images/Hothu.png', 'slug' => 'thiet-ke-ho-ga', 'title' => 'Thiết Kế Hố Ga', 'href' => '/huong-dan/thiet-ke-ho-ga.php'],
    ['image' => 'images/caudamT.png', 'slug' => 'thiet-ke-cau-gian-don', 'title' => 'Thiết Kế Cầu Giản Đơn BTCT DƯL', 'href' => '/huong-dan/thiet-ke-cau-gian-don.php'],
    ['image' => 'images/Index/index_Modun6_Kiemtoan_caugiandon.jpg', 'slug' => 'kiem-toan-cau-gian-don', 'title' => 'Kiểm Toán Cầu Giản Đơn', 'href' => '/huong-dan/kiem-toan-cau-gian-don.php'],
    ['image' => 'images/Index/index_Modun7_Kiemtoan_cauban.jpg', 'slug' => 'kiem-toan-cau-ban', 'title' => 'Kiểm Toán Cầu Bản', 'href' => '/huong-dan/kiem-toan-cau-ban.php'],
    ['image' => 'images/Index/index_Modun8_Kiemtoan_conghop.jpg', 'slug' => 'kiem-toan-cong-hop', 'title' => 'Kiểm Toán Cống Hộp', 'href' => '/huong-dan/kiem-toan-cong-hop.php'],
];

require __DIR__ . '/includes/header.php';
?>

<section>
    <h1 style="margin: 8px 0 10px; font-size: 1.9rem;">Hướng Dẫn Sử Dụng</h1>
    <p style="color: var(--text-muted); max-width: 60ch; margin-bottom: 32px;">
        Mỗi mô-đun có hướng dẫn sử dụng riêng, theo từng bước. Chọn mô-đun bên dưới để bắt đầu.
    </p>

    <div class="card-grid">
        <?php foreach ($guides as $g): ?>
        <div class="card-3d card-3d--guide" data-href="<?= htmlspecialchars($g['href']) ?>">
            
            <!-- ĐÃ CẬP NHẬT: Khung ảnh cố định 160px và tự động crop bằng CSS cover -->
            <div class="card-3d__thumb" style="width: 100%; height: 160px; overflow: hidden; background-color: #f4f6f9;">
                <?php if (!empty($g['image'])): ?>
                    <img src="<?= htmlspecialchars($g['image']) ?>" 
                         alt="<?= htmlspecialchars($g['title']) ?>" 
                         style="width: 100%; height: 100%; object-fit: cover; object-position: center; display: block;">
                <?php endif; ?>
            </div>
            
            <div class="card-3d__title"><?= htmlspecialchars($g['title']) ?></div>
            <div class="card-3d__actions">
                <div class="card-3d__actions-secondary">
                    <a href="<?= htmlspecialchars($g['href']) ?>" class="btn-3d btn-3d-blue">Hướng dẫn</a>
                    <a href="/ho-tro-truc-tuyen.php?mo-dun=<?= htmlspecialchars($g['slug']) ?>" class="btn-3d btn-3d-green">Trực tuyến</a>
                </div>
                <p class="card-3d__hint">Bấm "Trực tuyến" để gửi ID/Pass UltraView cho kỹ thuật viên hỗ trợ.</p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>