<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/src/bootstrap.php';
require __DIR__ . '/../includes/session.php';

use Htsoft\Lib\CreditService;
use Htsoft\Lib\Database;

header('Content-Type: application/json; charset=utf-8');

if ($currentUserId === null) {
    http_response_code(401);
    echo json_encode(['error' => 'Bạn cần đăng nhập trước.']);
    exit;
}

$packageId = (int) ($_POST['package_id'] ?? 0);

if ($packageId <= 0) {
    http_response_code(422);
    echo json_encode(['error' => 'Gói tín dụng không hợp lệ.']);
    exit;
}

$credit = new CreditService(Database::connection());

try {
    $newBalance = $credit->topUp($currentUserId, $packageId);
    echo json_encode(['status' => 'ok', 'balance' => $newBalance]);
} catch (\InvalidArgumentException $e) {
    http_response_code(422);
    echo json_encode(['error' => $e->getMessage()]);
}
