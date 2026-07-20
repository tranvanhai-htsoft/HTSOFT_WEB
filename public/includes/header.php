<?php
require __DIR__ . '/session.php';

$topbarBalance = null;
if ($currentUserId !== null) {
    require_once dirname(__DIR__, 2) . '/src/bootstrap.php';
    try {
        $topbarBalance = (new \Htsoft\Lib\CreditService(\Htsoft\Lib\Database::connection()))->getBalance($currentUserId);
    } catch (\Throwable $e) {
        $topbarBalance = null; // CSDL chưa sẵn sàng — vẫn hiện trang, chỉ ẩn số dư
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) . ' | HTSOFT' : 'HTSOFT — Phần mềm thiết kế hạ tầng giao thông' ?></title>
    <meta name="description" content="<?= isset($pageDescription) ? htmlspecialchars($pageDescription) : 'HTSOFT cung cấp bộ phần mềm thiết kế hạ tầng giao thông: Dradnet — cống, cầu bản, hố ga.' ?>">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

    <header class="topbar" id="topbar">
        <a href="/" class="logo-area">
            <img src="/assets/images/Logo.png" alt="HTSOFT">
        </a>
        <a href="tel:0905887868" class="topbar__hotline">
            <span aria-hidden="true">📞</span>
            <span>0905.88.78.68</span>
        </a>
        <nav>
            <ul>
                <li><a href="/">Trang chủ</a></li>
                <li><a href="/bao-gia.php">Báo giá</a></li>
                <li><a href="/huong-dan.php">Hướng dẫn</a></li>
                <?php if ($currentUserId !== null): ?>
                <li><a href="/tai-khoan.php" class="btn-3d btn-3d-yellow">Tài khoản<?= $topbarBalance !== null ? ' · ' . $topbarBalance . ' TD' : '' ?></a></li>
                <?php else: ?>
                <li><a href="/dang-nhap.php" class="btn-3d btn-3d-yellow">Đăng nhập</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
