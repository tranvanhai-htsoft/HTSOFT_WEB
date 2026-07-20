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

// Roadmap hướng dẫn sử dụng: click 1 bước để mở nội dung, đóng các bước khác
// (kiểu accordion) — không chuyển trang, đúng theo docs/CAUTAOWEB.docx
(function () {
    document.querySelectorAll('.guide-roadmap').forEach(function (roadmap) {
        roadmap.querySelectorAll('.guide-step__marker').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var step = btn.closest('.guide-step');
                var wasOpen = step.classList.contains('is-open');
                roadmap.querySelectorAll('.guide-step').forEach(function (s) {
                    s.classList.remove('is-open');
                });
                if (!wasOpen) step.classList.add('is-open');
            });
        });
    });
})();
