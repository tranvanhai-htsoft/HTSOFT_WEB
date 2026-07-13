<?php

namespace Htsoft\Lib;

/**
 * Gửi mật khẩu OTP qua Zalo Cloud Account (ZCA) — đăng nhập trực tiếp bằng một
 * tài khoản Zalo cá nhân/doanh nghiệp thay vì dùng API Zalo Notification Service
 * (ZNS) chính thức của Zalo Official Account.
 *
 * Lưu ý (SV2 đọc trước khi code): ZCA không phải API chính thức được Zalo cấp
 * phép cho mục đích gửi tin hàng loạt — dùng sai cách (gửi quá nhanh, quá nhiều
 * số lạ trong thời gian ngắn) có rủi ro bị khoá tài khoản Zalo đang dùng để gửi.
 * Nên: giới hạn tốc độ gửi, có phương án dự phòng gửi SMS OTP khi ZCA lỗi, và
 * theo dõi sát trong giai đoạn đầu vận hành thật.
 */
final class ZaloClient
{
    public function __construct(
        private readonly string $sessionPath,
    ) {
    }

    /**
     * @return bool true nếu gửi thành công
     */
    public function sendOtp(string $phoneNumber, string $otp): bool
    {
        // TODO(SV2): tích hợp thư viện client ZCA thật (vd: zca-js) tại đây.
        // Trong lúc chưa nối thật, ném exception để không âm thầm coi là đã gửi.
        throw new \RuntimeException('ZaloClient::sendOtp() chưa được cài đặt.');
    }
}
