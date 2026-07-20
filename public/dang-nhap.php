<?php
$pageTitle = 'Đăng nhập';
$pageDescription = 'Đăng nhập chỉ bằng số điện thoại — mật khẩu gửi qua Zalo/SMS.';
require __DIR__ . '/includes/header.php';
?>

<section>
    <span class="eyebrow">Đăng nhập</span>
    <h1 style="margin: 8px 0 20px; font-size: 1.9rem;">Đăng Nhập Bằng Số Điện Thoại</h1>

    <form id="loginForm" class="card-3d" style="max-width: 420px; gap: 16px;">
        <label for="phone" style="font-weight: 700; font-size: 0.9rem;">Số điện thoại</label>
        <input type="tel" id="phone" name="phone_number" required
               placeholder="09xxxxxxxx"
               style="padding: 10px 12px; border: 2px solid var(--ink); border-radius: 8px; font-size: 1rem;">

        <div id="passwordField" hidden>
            <label for="password" style="font-weight: 700; font-size: 0.9rem;">Mật khẩu</label>
            <input type="password" id="password" name="password"
                   style="padding: 10px 12px; border: 2px solid var(--ink); border-radius: 8px; font-size: 1rem; width: 100%; margin-top: 8px;">
        </div>

        <p id="loginMessage" style="font-size: 0.85rem; margin: 0;"></p>

        <button type="submit" id="loginSubmit" class="btn-3d btn-3d-blue">Tiếp tục</button>
    </form>

    <p style="color: var(--text-muted); font-size: 0.85rem; max-width: 60ch; margin-top: 16px;">
        Nếu số điện thoại đã có tài khoản, hệ thống hiện ô nhập mật khẩu.
        Nếu chưa có, hệ thống tự tạo tài khoản mới và gửi mật khẩu 6 số qua Zalo ZNS/SMS.
    </p>
</section>

<script>
(function () {
    var form = document.getElementById('loginForm');
    var phoneInput = document.getElementById('phone');
    var passwordField = document.getElementById('passwordField');
    var passwordInput = document.getElementById('password');
    var message = document.getElementById('loginMessage');
    var submitBtn = document.getElementById('loginSubmit');
    var step = 'phone'; // 'phone' -> 'password'

    function setMessage(text, isError) {
        message.textContent = text || '';
        message.style.color = isError ? '#c0392b' : 'inherit';
    }

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        if (step === 'phone') {
            var phone = phoneInput.value.trim();
            if (!phone) return;

            submitBtn.disabled = true;
            setMessage('Đang kiểm tra số điện thoại…', false);

            fetch('/api/check-phone.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'phone_number=' + encodeURIComponent(phone),
            })
                .then(function (r) { return r.json().then(function (data) { return { ok: r.ok, data: data }; }); })
                .then(function (res) {
                    submitBtn.disabled = false;
                    if (!res.ok) {
                        setMessage(res.data.error || 'Có lỗi xảy ra.', true);
                        return;
                    }
                    phoneInput.readOnly = true;
                    passwordField.hidden = false;
                    passwordInput.focus();
                    step = 'password';
                    submitBtn.textContent = 'Đăng nhập';
                    setMessage(res.data.message || '', false);
                })
                .catch(function () {
                    submitBtn.disabled = false;
                    setMessage('Không kết nối được máy chủ.', true);
                });
            return;
        }

        // step === 'password'
        var password = passwordInput.value;
        if (!password) return;

        submitBtn.disabled = true;
        setMessage('Đang đăng nhập…', false);

        fetch('/api/login.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'phone_number=' + encodeURIComponent(phoneInput.value.trim()) + '&password=' + encodeURIComponent(password),
        })
            .then(function (r) { return r.json().then(function (data) { return { ok: r.ok, data: data }; }); })
            .then(function (res) {
                submitBtn.disabled = false;
                if (!res.ok) {
                    setMessage(res.data.error || 'Đăng nhập thất bại.', true);
                    return;
                }
                window.location.href = '/tai-khoan.php';
            })
            .catch(function () {
                submitBtn.disabled = false;
                setMessage('Không kết nối được máy chủ.', true);
            });
    });
})();
</script>

<?php require __DIR__ . '/includes/footer.php'; ?>
