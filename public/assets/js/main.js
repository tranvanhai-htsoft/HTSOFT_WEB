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
