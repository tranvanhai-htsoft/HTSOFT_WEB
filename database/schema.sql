-- Schema HTSOFT Web — Giai đoạn 2
--
-- ⚠️ THAY ĐỔI KIẾN TRÚC: mô hình "thuê bao theo tháng" (subscriptions,
-- duration_months) mô tả trong docs/CAUTAOWEB.docx đã bị thay bằng mô hình
-- "tín dụng trả trước dùng chung cho mọi sản phẩm" theo yêu cầu trực tiếp
-- của Admin. Bảng `subscriptions` không còn tồn tại trong schema này.
--
-- Quy tắc nghiệp vụ:
--   - Khách hàng mua các gói tín dụng (credit_packages) để nạp vào 1 số dư
--     tín dụng DÙNG CHUNG (users.credit_balance) — không có ví riêng theo
--     từng sản phẩm.
--   - Mỗi sản phẩm (products.credit_cost) quy định số tín dụng bị trừ mỗi
--     lần khách sử dụng sản phẩm đó — mức trừ khác nhau tuỳ sản phẩm.
--   - Mọi lần cộng/trừ tín dụng đều ghi lại thành 1 dòng trong
--     credit_transactions (sổ cái) — vừa để tính số dư, vừa để khách tải
--     lịch sử sử dụng.
--   - users.credit_balance là giá trị CACHE, phải luôn bằng
--     SUM(credit_transactions.amount) của user đó — xem src/lib/CreditService.php,
--     mọi thay đổi số dư PHẢI đi qua service này để không bị lệch.

CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    phone_number VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,      -- bcrypt hash
    name VARCHAR(150) NULL,
    company_name VARCHAR(200) NULL,
    credit_balance INT NOT NULL DEFAULT 0,        -- cache, xem ghi chú ở trên
    low_credit_threshold INT NULL,                -- ngưỡng cảnh báo riêng; NULL = dùng ngưỡng mặc định toàn hệ thống
    status ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS products (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(150) NOT NULL,   -- vd: Cống Tròn & Cống Hộp Đúc Sẵn, Kiểm Toán Cầu Bản...
    description TEXT NULL,
    credit_cost INT UNSIGNED NOT NULL DEFAULT 1,  -- số tín dụng bị trừ mỗi lần dùng sản phẩm này
    base_price DECIMAL(12, 2) NOT NULL DEFAULT 0, -- giá niêm yết tham khảo (marketing) — KHÔNG dùng để trừ tín dụng
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS credit_packages (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    package_name VARCHAR(150) NOT NULL,   -- vd: "Gói 100 tín dụng"
    credit_amount INT UNSIGNED NOT NULL,  -- số tín dụng khách nhận được khi mua gói này
    price DECIMAL(12, 2) NOT NULL,        -- giá bán gói (VNĐ)
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS credit_transactions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    type ENUM('topup', 'usage', 'adjustment') NOT NULL,
    amount INT NOT NULL,                  -- dương = cộng tín dụng (topup/adjustment), âm = trừ tín dụng (usage)
    balance_after INT NOT NULL,           -- số dư NGAY SAU giao dịch này — hiển thị lịch sử nhanh, không cần tính lại
    product_id INT UNSIGNED NULL,         -- sản phẩm nào tiêu tín dụng (chỉ có khi type = usage)
    credit_package_id INT UNSIGNED NULL,  -- gói nào được mua (chỉ có khi type = topup qua gói)
    description VARCHAR(255) NULL,        -- vd: "Mua gói 100 tín dụng", "Sử dụng Kiểm Toán Cầu Bản"
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_credit_tx_user FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT fk_credit_tx_product FOREIGN KEY (product_id) REFERENCES products(id),
    CONSTRAINT fk_credit_tx_package FOREIGN KEY (credit_package_id) REFERENCES credit_packages(id),
    INDEX idx_credit_tx_user_time (user_id, created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS desktop_sync_logs (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    sync_token VARCHAR(255) NOT NULL,
    last_sync_at TIMESTAMP NULL,
    CONSTRAINT fk_sync_logs_user FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
