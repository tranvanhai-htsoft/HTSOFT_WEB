-- Dữ liệu demo để đăng nhập thử & test giao diện tín dụng — CHỈ dùng cho máy dev local,
-- không chạy file này trên database production.
--
-- Yêu cầu chạy SAU database/schema.sql (cần bảng products đã có sẵn slug 'thiet-ke-ho-ga').
--
-- Cách chạy (nhớ --default-character-set=utf8mb4, thiếu cờ này chữ tiếng Việt sẽ bị lỗi mojibake):
--   mysql --default-character-set=utf8mb4 -u root htsoft_web < database/seed-demo.sql
--
-- Sau khi chạy, đăng nhập tại /dang-nhap.php với:
--   Số điện thoại: 0900000000
--   Mật khẩu:      123456

INSERT INTO users (phone_number, password, name, credit_balance, status)
VALUES (
    '0900000000',
    '$2y$10$L6.LRnijVtrpTKfiEIz/muUwFaeXVybEW5ZDRxSICwG7c7fJdEAa2', -- bcrypt hash của '123456'
    'Demo User',
    47,
    'active'
)
ON DUPLICATE KEY UPDATE
    password = VALUES(password),
    credit_balance = VALUES(credit_balance),
    status = VALUES(status);

INSERT INTO credit_packages (package_name, credit_amount, price, is_active)
VALUES
    ('Gói 50 tín dụng', 50, 500000, 1),
    ('Gói 100 tín dụng', 100, 900000, 1)
ON DUPLICATE KEY UPDATE
    credit_amount = VALUES(credit_amount),
    price = VALUES(price);

SET @uid = (SELECT id FROM users WHERE phone_number = '0900000000');
SET @pid_hoga = (SELECT id FROM products WHERE slug = 'thiet-ke-ho-ga');
SET @pkg_id = (SELECT id FROM credit_packages WHERE package_name = 'Gói 50 tín dụng');

-- Xoá giao dịch demo cũ (nếu chạy lại file này nhiều lần) trước khi ghi lại, tránh nhân đôi lịch sử
DELETE FROM credit_transactions WHERE user_id = @uid AND description LIKE '%(demo)';

INSERT INTO credit_transactions (user_id, type, amount, balance_after, credit_package_id, description)
VALUES (@uid, 'topup', 50, 50, @pkg_id, 'Nạp gói 50 tín dụng (demo)');

INSERT INTO credit_transactions (user_id, type, amount, balance_after, product_id, description)
VALUES (@uid, 'usage', -3, 47, @pid_hoga, 'Dùng thử Thiết Kế Hố Ga (demo)');
