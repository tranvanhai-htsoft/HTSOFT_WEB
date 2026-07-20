<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/src/bootstrap.php';
require __DIR__ . '/../includes/session.php';

use Htsoft\Lib\Auth;
use Htsoft\Lib\Database;
use Htsoft\Lib\ZaloClient;

header('Content-Type: application/json; charset=utf-8');

$phoneNumber = trim((string) ($_POST['phone_number'] ?? ''));
$password = (string) ($_POST['password'] ?? '');

if ($phoneNumber === '' || $password === '') {
    http_response_code(422);
    echo json_encode(['error' => 'Vui lòng nhập số điện thoại và mật khẩu.']);
    exit;
}

$db = Database::connection();
$zalo = new ZaloClient(htsoft_env('ZALO_ZCA_SESSION_PATH', './storage/zca-session.json'));
$auth = new Auth($db, $zalo);

if (!$auth->verifyPassword($phoneNumber, $password)) {
    http_response_code(401);
    echo json_encode(['error' => 'Số điện thoại hoặc mật khẩu không đúng.']);
    exit;
}

$stmt = $db->prepare('SELECT id FROM users WHERE phone_number = ? LIMIT 1');
$stmt->execute([$phoneNumber]);
$userId = (int) $stmt->fetchColumn();

session_regenerate_id(true);
$_SESSION['user_id'] = $userId;
$_SESSION['phone_number'] = $phoneNumber;

echo json_encode(['status' => 'ok']);
