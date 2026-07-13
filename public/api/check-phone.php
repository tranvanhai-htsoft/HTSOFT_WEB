<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/src/bootstrap.php';

use Htsoft\Lib\Auth;
use Htsoft\Lib\Database;
use Htsoft\Lib\ZaloClient;

header('Content-Type: application/json; charset=utf-8');

$phoneNumber = trim((string) ($_POST['phone_number'] ?? ''));

if ($phoneNumber === '' || !preg_match('/^0\d{9,10}$/', $phoneNumber)) {
    http_response_code(422);
    echo json_encode(['error' => 'Số điện thoại không hợp lệ.']);
    exit;
}

$db = Database::connection(); // nạp src/config/database.php, khai báo hàm htsoft_env()
$zalo = new ZaloClient(htsoft_env('ZALO_ZCA_SESSION_PATH', './storage/zca-session.json'));
$auth = new Auth($db, $zalo);

if ($auth->phoneExists($phoneNumber)) {
    echo json_encode(['status' => 'existing', 'message' => 'Vui lòng nhập mật khẩu.']);
    exit;
}

// TODO(SV2): bọc try/catch quanh registerWithGeneratedPassword() khi ZaloClient
// đã cài đặt thật, để trả lỗi rõ ràng nếu gửi Zalo/SMS thất bại.
$userId = $auth->registerWithGeneratedPassword($phoneNumber);

echo json_encode([
    'status' => 'created',
    'message' => 'Đã tạo tài khoản mới, mật khẩu đã được gửi qua Zalo/SMS.',
    'user_id' => $userId,
]);
