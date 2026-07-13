// HTSOFT WEB — script dùng chung: ẩn/hiện topbar khi cuộn
(function () {
    var topbar = document.getElementById('topbar');
    var lastScrollY = window.scrollY;

    if (!topbar) return;

    window.addEventListener('scroll', function () {
        var currentScrollY = window.scrollY;
        var scrollingDown = currentScrollY > lastScrollY;

        if (scrollingDown && currentScrollY > 120) {
            topbar.classList.add('hide');
        } else {
            topbar.classList.remove('hide');
        }

        lastScrollY = currentScrollY;
    });
})();

// Thẻ sản phẩm (.card-3d[data-href]): toàn bộ vùng thẻ click được, trừ nút/link bên trong
(function () {
    document.querySelectorAll('.card-3d[data-href]').forEach(function (card) {
        card.addEventListener('click', function (e) {
            if (e.target.closest('a, button')) return;
            window.location.href = card.dataset.href;
        });
    });
})();

// Nút "Tích chọn mua": chuyển trạng thái đã chọn/chưa chọn cho bộ tính báo giá
// TODO(SV2): nối vào giỏ chọn mô-đun thật khi làm public/bao-gia.php
(function () {
    document.querySelectorAll('.btn-3d-select').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var selected = btn.classList.toggle('is-selected');
            btn.textContent = selected ? 'Đã chọn ✓' : 'Tích chọn mua';
            btn.setAttribute('aria-pressed', selected ? 'true' : 'false');
        });
    });
})();
