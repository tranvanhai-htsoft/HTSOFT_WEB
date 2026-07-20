<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/src/bootstrap.php';
require __DIR__ . '/../includes/session.php';

use Htsoft\Lib\CreditService;
use Htsoft\Lib\Database;
use Htsoft\Lib\InsufficientCreditException;

header('Content-Type: application/json; charset=utf-8');

if ($currentUserId === null) {
    http_response_code(401);
    echo json_encode(['error' => 'Bạn cần đăng nhập trước.']);
    exit;
}

$slug = trim((string) ($_POST['slug'] ?? ''));

if ($slug === '') {
    http_response_code(422);
    echo json_encode(['error' => 'Thiếu mã sản phẩm.']);
    exit;
}

$db = Database::connection();

$stmt = $db->prepare('SELECT id FROM products WHERE slug = ? LIMIT 1');
$stmt->execute([$slug]);
$productId = $stmt->fetchColumn();

if ($productId === false) {
    http_response_code(404);
    echo json_encode(['error' => 'Không tìm thấy sản phẩm này.']);
    exit;
}

$credit = new CreditService($db);

try {
    $newBalance = $credit->consume($currentUserId, (int) $productId);
    echo json_encode(['status' => 'ok', 'balance' => $newBalance]);
} catch (InsufficientCreditException $e) {
    http_response_code(402);
    echo json_encode(['error' => $e->getMessage()]);
} catch (\InvalidArgumentException $e) {
    http_response_code(422);
    echo json_encode(['error' => $e->getMessage()]);
}
