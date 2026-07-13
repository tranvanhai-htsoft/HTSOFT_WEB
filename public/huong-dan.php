<?php
$pageTitle = 'Hướng dẫn sử dụng';
$pageDescription = 'Chọn mô-đun để xem hướng dẫn sử dụng chi tiết theo từng bước.';

// Danh sách phải khớp với $modules trong index.php — mỗi mô-đun có 1 trang hướng dẫn riêng.
$guides = [
    ['icon' => '🔵', 'slug' => 'cong-tron-cong-hop-duc-san', 'title' => 'Cống Tròn & Cống Hộp Đúc Sẵn', 'href' => '/huong-dan/cong-tron-cong-hop-duc-san.php'],
    ['icon' => '📦', 'slug' => 'cong-hop-do-tai-cho', 'title' => 'Cống Hộp Đổ Tại Chỗ', 'href' => '/huong-dan/cong-hop-do-tai-cho.php'],
    ['icon' => '🌉', 'slug' => 'cau-ban-cong-ban-tran-lien-hop', 'title' => 'Cầu Bản – Cống Bản – Tràn Liên Hợp', 'href' => '/huong-dan/cau-ban-cong-ban-tran-lien-hop.php'],
    ['icon' => '🕳️', 'slug' => 'thiet-ke-ho-ga', 'title' => 'Thiết Kế Hố Ga', 'href' => '/huong-dan/thiet-ke-ho-ga.php'],
];

require __DIR__ . '/includes/header.php';
?>

<section>
    <span class="eyebrow">Interactive user guide</span>
    <h1 style="margin: 8px 0 10px; font-size: 1.9rem;">Hướng Dẫn Sử Dụng</h1>
    <p style="color: var(--text-muted); max-width: 60ch; margin-bottom: 32px;">
        Mỗi mô-đun có hướng dẫn sử dụng riêng, theo từng bước. Chọn mô-đun bên dưới để bắt đầu.
    </p>

    <div class="card-grid">
        <?php foreach ($guides as $g): ?>
        <div class="card-3d" data-href="<?= htmlspecialchars($g['href']) ?>">
            <div class="card-3d__icon"><?= $g['icon'] ?></div>
            <div class="card-3d__title"><?= htmlspecialchars($g['title']) ?></div>
            <div class="card-3d__actions">
                <div class="card-3d__actions-secondary">
                    <a href="<?= htmlspecialchars($g['href']) ?>" class="btn-3d btn-3d-blue">Xem hướng dẫn</a>
                    <a href="/ho-tro-truc-tuyen.php?mo-dun=<?= htmlspecialchars($g['slug']) ?>" class="btn-3d btn-3d-green">Trực tuyến</a>
                </div>
                <p class="card-3d__hint">Bấm "Trực tuyến" để gửi ID/Pass UltraView cho kỹ thuật viên hỗ trợ.</p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
