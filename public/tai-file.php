<?php

declare(strict_types=1);

require __DIR__ . '/includes/session.php';

if ($currentUserId === null) {
    http_response_code(401);
    exit('Bạn cần đăng nhập trước khi tải file.');
}

$downloads = require dirname(__DIR__) . '/src/config/downloads.php';

$slug = (string) ($_GET['slug'] ?? '');
$variantKey = (string) ($_GET['variant'] ?? '');

if (!isset($downloads[$slug]['variants'][$variantKey])) {
    http_response_code(404);
    exit('Không tìm thấy file cài đặt này.');
}

$fileName = $downloads[$slug]['variants'][$variantKey]['file'];
$filePath = dirname(__DIR__) . '/storage/downloads/' . $fileName;

if (!is_file($filePath)) {
    http_response_code(404);
    exit('File chưa được tải lên máy chủ. Vui lòng liên hệ hỗ trợ.');
}

header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="' . $fileName . '"');
header('Content-Length: ' . filesize($filePath));
header('X-Content-Type-Options: nosniff');
readfile($filePath);
exit;
