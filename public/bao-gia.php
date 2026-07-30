<?php
require __DIR__ . '/includes/config.php';

$pageTitle = 'Bộ tính báo giá';
$pageDescription = 'Chọn mô-đun, phiên bản và khóa tích hợp để nhận báo giá ngay.';

/**
 * Cấu hình giá – nguồn duy nhất cho cả PHP (render lần đầu) và JS (tính realtime).
 */
$LOCK_FEE = 500000;

$modules = [
    'cong-tron-cong-hop-duc-san' => [
        'name' => 'Mô-đun 1: Cống Tròn & Cống Hộp Đúc Sẵn ' . MODULE_YEAR,
        'icon' => '🔵',
        'versions' => [
            ['id' => 'standard', 'label' => 'Tiêu chuẩn', 'price' => 3600000, 'available' => true],
            ['id' => 'full', 'label' => 'Full nâng cao', 'price' => 4900000, 'available' => true],
        ],
    ],
    'cong-hop-do-tai-cho' => [
        'name' => 'Mô-đun 2: Cống Hộp Đổ Tại Chỗ ' . MODULE_YEAR,
        'icon' => '📦',
        'versions' => [
            ['id' => 'standard', 'label' => 'Tiêu chuẩn', 'price' => 3600000, 'available' => true],
            ['id' => 'full', 'label' => 'Full nâng cao', 'price' => 4900000, 'available' => true],
        ],
    ],
    'cau-ban-cong-ban-tran-lien-hop' => [
        'name' => 'Mô-đun 3: Cầu Bản – Cống Bản – Tràn Liên Hợp ' . MODULE_YEAR,
        'icon' => '🌉',
        'versions' => [
            ['id' => 'standard', 'label' => 'Tiêu chuẩn', 'price' => 3600000, 'available' => true],
            ['id' => 'full', 'label' => 'Full nâng cao', 'price' => 0, 'available' => false],
        ],
    ],
    'thiet-ke-ho-ga' => [
        'name' => 'Mô-đun 4: Thiết Kế Hố Ga ' . MODULE_YEAR,
        'icon' => '🕳️',
        'versions' => [
            ['id' => 'standard', 'label' => 'Một phiên bản', 'price' => 2600000, 'available' => true],
        ],
    ],
    'thiet-ke-cau-gian-don' => [
        'name' => 'Mô-đun 5: Thiết Kế Cầu Giản Đơn BTCT DƯL ' . MODULE_YEAR,
        'icon' => '🌁',
        'versions' => [
            ['id' => 'standard', 'label' => 'Một phiên bản', 'price' => 5900000, 'available' => true],
        ],
    ],
    'kiem-toan-cau-gian-don' => [
        'name' => 'Mô-đun 6: Kiểm Toán Cầu Giản Đơn ' . MODULE_YEAR,
        'icon' => '📐',
        'versions' => [
            ['id' => 'standard', 'label' => 'Một phiên bản', 'price' => 2900000, 'available' => true],
        ],
    ],
    'kiem-toan-cau-ban' => [
        'name' => 'Mô-đun 7: Kiểm Toán Cầu Bản ' . MODULE_YEAR,
        'icon' => '📊',
        'versions' => [
            ['id' => 'standard', 'label' => 'Một phiên bản', 'price' => 2900000, 'available' => true],
        ],
    ],
    'kiem-toan-cong-hop' => [
        'name' => 'Mô-đun 8: Kiểm Toán Cống Hộp ' . MODULE_YEAR,
        'icon' => '🧮',
        'versions' => [
            ['id' => 'standard', 'label' => 'Một phiên bản', 'price' => 2900000, 'available' => true],
        ],
    ],
];

$modulesJson = json_encode($modules, JSON_UNESCAPED_UNICODE);
$lockFeeJson = json_encode($LOCK_FEE);

require __DIR__ . '/includes/header.php';
?>

<section>
    <span class="eyebrow">Pricing calculator</span>
    <h1 style="margin: 8px 0 8px; font-size: 1.9rem;">Bộ Tính Báo Giá</h1>
    <p class="card-3d__desc" style="max-width: 640px; margin-bottom: 28px;">
        Tích chọn các mô-đun cần dùng, chọn phiên bản và gán khóa tích hợp — hệ thống sẽ tự
        động cập nhật tổng tiền theo thời gian thực.
    </p>

    <div class="quote-layout">
        <!-- ===================== DANH SÁCH MÔ-ĐUN ===================== -->
        <div class="quote-modules" id="quoteModules">
            <?php foreach ($modules as $slug => $m): ?>
            <div class="quote-card" data-slug="<?= htmlspecialchars($slug) ?>" hidden>
                <div class="quote-card__head">
                    <span class="quote-card__icon"><?= $m['icon'] ?></span>
                    <span class="quote-card__title"><?= htmlspecialchars($m['name']) ?></span>
                    <button type="button" class="quote-card__remove" data-slug="<?= htmlspecialchars($slug) ?>" title="Bỏ chọn mô-đun này">✕ Bỏ chọn</button>
                </div>

                <div class="quote-card__body">
                    <?php if (count($m['versions']) > 1): ?>
                    <div class="quote-field">
                        <span class="quote-field__label">Phiên bản</span>
                        <div class="quote-versions">
                            <?php foreach ($m['versions'] as $i => $v): ?>
                            <label class="quote-version <?= !$v['available'] ? 'is-disabled' : '' ?>">
                                <input type="radio" name="version-<?= htmlspecialchars($slug) ?>"
                                       value="<?= htmlspecialchars($v['id']) ?>"
                                       class="qm-version" data-slug="<?= htmlspecialchars($slug) ?>"
                                       <?= $i === 0 ? 'checked' : '' ?> <?= !$v['available'] ? 'disabled' : '' ?>>
                                <span>
                                    <?= htmlspecialchars($v['label']) ?><br>
                                    <b><?= $v['available'] ? number_format($v['price'], 0, ',', '.') . 'đ' : 'Chưa phát hành' ?></b>
                                </span>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php else: ?>
                    <input type="hidden" class="qm-version" data-slug="<?= htmlspecialchars($slug) ?>" value="<?= htmlspecialchars($m['versions'][0]['id']) ?>">
                    <div class="quote-field">
                        <span class="quote-field__label">Giá</span>
                        <b><?= number_format($m['versions'][0]['price'], 0, ',', '.') ?>đ</b>
                    </div>
                    <?php endif; ?>

                    <div class="quote-field">
                        <span class="quote-field__label">Khóa tích hợp</span>
                        <div class="qm-lock-row">
                            <span class="qm-lock-static" data-slug="<?= htmlspecialchars($slug) ?>">Khóa 1</span>
                            <select class="qm-lock" data-slug="<?= htmlspecialchars($slug) ?>" hidden></select>
                            <button type="button" class="qm-lock-split" data-slug="<?= htmlspecialchars($slug) ?>">Tách khóa riêng</button>
                        </div>
                    </div>

                    <div class="quote-card__price">
                        Đơn giá sau khấu trừ: <b class="qm-unit-price">—</b>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

            <p class="quote-empty" id="quoteEmpty">
                Bạn chưa chọn mô-đun nào. Vui lòng quay lại
                <a href="/index.php">trang danh mục</a> và bấm “Chọn mua” trên các mô-đun mong muốn.
            </p>
        </div>

        <!-- ===================== TỔNG THANH TOÁN ===================== -->
        <aside class="quote-summary" id="quoteSummary" hidden>
            <div class="card-3d">
                <div class="card-3d__title">Tổng thanh toán</div>
                <div class="quote-row"><span>Tạm tính</span><b id="sumSubtotal">0đ</b></div>
                <div class="quote-row quote-row--discount"><span>Khấu trừ phí khóa trùng</span><b id="sumLockDiscount">0đ</b></div>
                <div class="quote-row quote-row--discount"><span>Chiết khấu theo số lượng</span><b id="sumQtyDiscount">0đ</b></div>
                <div class="quote-row quote-row--total"><span>Thành tiền</span><b id="sumTotal">0đ</b></div>
                <div class="quote-summary__hint" id="sumHint"></div>
                <button type="button" class="btn-3d btn-3d-yellow" id="btnCheckout" style="width:100%; margin-top:14px;">Thanh toán</button>
            </div>
        </aside>
    </div>

    <!-- ===================== FORM THANH TOÁN ===================== -->
    <div class="quote-checkout" id="quoteCheckout" hidden>
        <div class="card-3d" style="max-width: 640px;">
            <div class="card-3d__title">Thông tin đặt hàng</div>
            <form id="checkoutForm" class="quote-form">
                <label>Số điện thoại *<input type="tel" name="phone" required pattern="[0-9+ ]{8,15}"></label>
                <label>Mã số thuế<input type="text" name="tax_code" id="taxCodeInput" inputmode="numeric" autocomplete="off" placeholder="VD: 0106026495"></label>
                <div class="quote-form__full tax-lookup" id="taxLookupResult" hidden></div>
                <label class="quote-form__full">Ghi chú<textarea name="note" rows="3"></textarea></label>

                <div class="quote-form__full">
                    <span class="quote-field__label">Phương thức thanh toán</span>
                    <div class="quote-versions">
                        <label class="quote-version"><input type="radio" name="payment_method" value="qr" checked><span>Quét mã QR</span></label>
                        <label class="quote-version"><input type="radio" name="payment_method" value="bank"><span>Chuyển khoản ngân hàng</span></label>
                    </div>
                </div>

                <div class="quote-form__full quote-form__total">
                    Tổng thanh toán: <b id="checkoutTotal">0đ</b>
                </div>

                <div class="quote-form__full" style="display:flex; gap:12px;">
                    <button type="submit" class="btn-3d btn-3d-yellow">Xác nhận đặt hàng</button>
                    <button type="button" class="btn-3d btn-3d-blue" id="btnBackToQuote">Quay lại</button>
                </div>
            </form>
            <div id="checkoutResult" hidden></div>
        </div>
    </div>
</section>

<style>
.quote-layout { display: grid; grid-template-columns: 1fr 320px; gap: 24px; align-items: start; }
@media (max-width: 860px) { .quote-layout { grid-template-columns: 1fr; } }

.quote-modules { display: flex; flex-direction: column; gap: 14px; }
.quote-card { border: 1px solid rgba(255,255,255,0.12); border-radius: 14px; padding: 16px 18px; background: rgba(255,255,255,0.03); }
.quote-card__head { display: flex; align-items: center; gap: 10px; font-weight: 600; }
.quote-card__icon { font-size: 1.2rem; }
.quote-card__title { flex: 1; }
.quote-card__remove { background: none; border: 1px solid rgba(255,255,255,0.2); border-radius: 8px; padding: 4px 10px; font-size: 0.78rem; opacity: 0.7; cursor: pointer; color: inherit; white-space: nowrap; }
.quote-card__remove:hover { opacity: 1; border-color: #e05555; color: #e05555; }
.quote-card__body { margin-top: 14px; padding-top: 14px; border-top: 1px dashed rgba(255,255,255,0.15); display: flex; flex-direction: column; gap: 12px; }
.quote-field { display: flex; flex-direction: column; gap: 6px; }
.quote-field__label { font-size: 0.82rem; opacity: 0.7; }
.quote-versions { display: flex; flex-wrap: wrap; gap: 10px; }
.quote-version { display: flex; align-items: center; gap: 8px; border: 1px solid rgba(255,255,255,0.15); border-radius: 10px; padding: 8px 12px; cursor: pointer; font-size: 0.88rem; }
.quote-version.is-disabled { opacity: 0.45; cursor: not-allowed; }
.qm-lock { padding: 8px 10px; border-radius: 8px; background: #ffffff; color: #1b1b22; border: 1px solid rgba(0,0,0,0.2); }
.qm-lock-row { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }
.qm-lock-static { font-weight: 600; }
.qm-lock-split { background: none; border: none; padding: 0; font-size: 0.8rem; color: #4d9dff; text-decoration: underline; cursor: pointer; }
.qm-lock-split:hover { color: #7fbaff; }
.quote-card__price { font-size: 0.9rem; opacity: 0.85; }
.quote-empty { opacity: 0.65; font-size: 0.9rem; }

.quote-summary { position: sticky; top: 20px; }
.quote-row { display: flex; justify-content: space-between; padding: 6px 0; font-size: 0.92rem; }
.quote-row--discount b { color: #7cd992; }
.quote-row--total { border-top: 1px solid rgba(255,255,255,0.15); margin-top: 8px; padding-top: 10px; font-size: 1.15rem; }
.quote-summary__hint { font-size: 0.78rem; opacity: 0.6; margin-top: 4px; }

.quote-checkout { margin-top: 26px; }
.quote-form { display: grid; grid-template-columns: 1fr 1fr; gap: 12px 16px; margin-top: 12px; }
.quote-form label { display: flex; flex-direction: column; gap: 6px; font-size: 0.88rem; }
.quote-form input, .quote-form textarea { padding: 9px 10px; border-radius: 8px; border: 1px solid rgba(0,0,0,0.2); background: #ffffff; color: #1b1b22; }
.quote-form__full { grid-column: 1 / -1; }
.quote-form__total { font-size: 1.05rem; text-align: right; }

.tax-lookup { font-size: 0.85rem; padding: 10px 12px; border-radius: 8px; border: 1px solid rgba(0,0,0,0.12); background: rgba(0,0,0,0.03); margin-top: -4px; }
.tax-lookup.is-loading { opacity: 0.7; }
.tax-lookup.is-found { border-color: #2e7d32; background: rgba(46,125,50,0.08); }
.tax-lookup.is-error { border-color: #f05431; background: rgba(240,84,49,0.08); }
</style>

<script>
(function () {
    var MODULES = <?= $modulesJson ?>;
    var LOCK_FEE = <?= $lockFeeJson ?>;
    var STORAGE_KEY = 'druong_selected_modules'; // written by index.php "Chọn mua" buttons

    var state = {}; // slug -> { checked, version, lock }
    var lockCounter = 1;
    var businessInfo = null; // kết quả tra cứu công ty theo mã số thuế, gửi kèm khi đặt hàng
    var taxLookupTimer = null;

    function fmt(n) {
        return Math.round(n).toLocaleString('vi-VN') + 'đ';
    }

    function getInitialSlugs() {
        var slugs = [];
        try {
            var params = new URLSearchParams(window.location.search);
            if (params.get('modules')) slugs = params.get('modules').split(',');
        } catch (e) {}
        if (!slugs.length) {
            try {
                var raw = localStorage.getItem(STORAGE_KEY);
                if (raw) slugs = JSON.parse(raw);
            } catch (e) {}
        }
        return slugs.filter(function (s) { return MODULES.hasOwnProperty(s); });
    }

    function persistSelection() {
        var slugs = Object.keys(state).filter(function (s) { return state[s].checked; });
        try { localStorage.setItem(STORAGE_KEY, JSON.stringify(slugs)); } catch (e) {}
    }

    function initState() {
        var preselected = getInitialSlugs();
        Object.keys(MODULES).forEach(function (slug) {
            state[slug] = { checked: preselected.indexOf(slug) !== -1, version: MODULES[slug].versions[0].id, lock: 'Khóa 1' };
        });
    }

    function versionPrice(slug, versionId) {
        var v = MODULES[slug].versions.find(function (x) { return x.id === versionId; });
        return v && v.available ? v.price : 0;
    }

    function activeSlugs() {
        return Object.keys(state).filter(function (s) { return state[s].checked; });
    }

    // Yêu cầu 2: sau mỗi thay đổi, đánh lại số thứ tự khóa cho liên tục
    // (dựa trên thứ tự xuất hiện đầu tiên trong danh sách mô-đun đang chọn).
    function renumberLocks() {
        var slugs = activeSlugs();
        var order = [];
        slugs.forEach(function (s) {
            if (order.indexOf(state[s].lock) === -1) order.push(state[s].lock);
        });
        var mapping = {};
        order.forEach(function (oldLabel, idx) { mapping[oldLabel] = 'Khóa ' + (idx + 1); });
        slugs.forEach(function (s) { state[s].lock = mapping[state[s].lock]; });
    }

    function distinctLockCount() {
        var set = {};
        activeSlugs().forEach(function (s) { set[state[s].lock] = true; });
        return Object.keys(set).length;
    }

    // Yêu cầu 1: mặc định Khóa 1, chỉ hiện dropdown khi có từ 2 khóa trở lên.
    function updateLockUI() {
        var slugs = activeSlugs();
        var multi = distinctLockCount() > 1;

        var maxLockNum = 0;
        slugs.forEach(function (s) {
            var m = /Khóa (\d+)/.exec(state[s].lock);
            if (m) maxLockNum = Math.max(maxLockNum, parseInt(m[1], 10));
        });
        var options = [];
        for (var i = 1; i <= Math.max(maxLockNum, 1); i++) options.push('Khóa ' + i);
        var nextLock = 'Khóa ' + (Math.max(maxLockNum, 1) + 1);

        slugs.forEach(function (slug) {
            var card = document.querySelector('.quote-card[data-slug="' + slug + '"]');
            var staticEl = card.querySelector('.qm-lock-static');
            var selectEl = card.querySelector('.qm-lock');
            var splitBtn = card.querySelector('.qm-lock-split');

            if (multi) {
                staticEl.hidden = true;
                splitBtn.hidden = true;
                selectEl.hidden = false;
                selectEl.innerHTML = '';
                options.concat([nextLock]).forEach(function (label, idx) {
                    var opt = document.createElement('option');
                    opt.value = label;
                    opt.textContent = idx < options.length ? label : label + ' (mới)';
                    selectEl.appendChild(opt);
                });
                selectEl.value = state[slug].lock;
            } else {
                selectEl.hidden = true;
                staticEl.hidden = false;
                staticEl.textContent = state[slug].lock;
                // Chỉ cho tách khóa khi có từ 2 mô-đun trở lên đang chọn.
                splitBtn.hidden = slugs.length < 2;
            }
        });
    }

    function calc() {
        var slugs = activeSlugs();
        var n = slugs.length;
        var subtotal = 0;
        slugs.forEach(function (s) { subtotal += versionPrice(s, state[s].version); });

        // Khấu trừ phí khóa trùng: mỗi mô-đun dư trong cùng 1 khóa trừ 500.000đ
        var byLock = {};
        slugs.forEach(function (s) { byLock[state[s].lock] = (byLock[state[s].lock] || 0) + 1; });
        var lockDiscount = 0;
        Object.keys(byLock).forEach(function (l) {
            if (byLock[l] > 1) lockDiscount += (byLock[l] - 1) * LOCK_FEE;
        });

        // Chiết khấu theo số lượng module
        var perModuleQtyDiscount = 0;
        if (n === 1) perModuleQtyDiscount = 0;
        else if (n === 2) perModuleQtyDiscount = 100000;
        else if (n >= 3 && n <= 9) perModuleQtyDiscount = 300000;
        else if (n > 9) perModuleQtyDiscount = 800000;
        var qtyDiscount = perModuleQtyDiscount * n;

        var totalDiscount = lockDiscount + qtyDiscount;
        var total = Math.max(subtotal - totalDiscount, 0);
        var discountPerModule = n > 0 ? totalDiscount / n : 0;

        return { n: n, subtotal: subtotal, lockDiscount: lockDiscount, qtyDiscount: qtyDiscount, total: total, discountPerModule: discountPerModule, slugs: slugs };
    }

    function render() {
        renumberLocks();
        var result = calc();

        Object.keys(MODULES).forEach(function (slug) {
            var card = document.querySelector('.quote-card[data-slug="' + slug + '"]');
            card.hidden = !state[slug].checked;

            if (state[slug].checked) {
                var listPrice = versionPrice(slug, state[slug].version);
                var unit = Math.max(listPrice - result.discountPerModule, 0);
                card.querySelector('.qm-unit-price').textContent = fmt(unit);
            }
        });

        document.getElementById('quoteEmpty').hidden = result.n > 0;
        document.getElementById('quoteSummary').hidden = result.n === 0;
        document.getElementById('quoteCheckout').hidden = true;

        document.getElementById('sumSubtotal').textContent = fmt(result.subtotal);
        document.getElementById('sumLockDiscount').textContent = result.lockDiscount ? '-' + fmt(result.lockDiscount) : fmt(0);
        document.getElementById('sumQtyDiscount').textContent = result.qtyDiscount ? '-' + fmt(result.qtyDiscount) : fmt(0);
        document.getElementById('sumTotal').textContent = fmt(result.total);
        document.getElementById('checkoutTotal').textContent = fmt(result.total);
        document.getElementById('sumHint').textContent = result.n + ' mô-đun đã chọn';

        updateLockUI();
        persistSelection();
    }

    // Tự động tra cứu tên/địa chỉ công ty theo mã số thuế (dữ liệu công khai từ
    // Tổng cục Thuế qua api.vietqr.io) để khách không phải tự gõ thông tin công ty.
    function setTaxResult(html, cls) {
        var el = document.getElementById('taxLookupResult');
        el.hidden = !html;
        el.className = 'quote-form__full tax-lookup' + (cls ? ' ' + cls : '');
        el.innerHTML = html || '';
    }

    function lookupTaxCode(code) {
        businessInfo = null;
        if (!/^\d{10}(\d{3})?$/.test(code)) {
            setTaxResult('');
            return;
        }
        setTaxResult('Đang tra cứu thông tin công ty…', 'is-loading');
        fetch('https://api.vietqr.io/v2/business/' + encodeURIComponent(code))
            .then(function (r) { return r.json(); })
            .then(function (json) {
                if (json && json.code === '00' && json.data) {
                    businessInfo = json.data;
                    setTaxResult(
                        '<b>' + json.data.name + '</b><br>' + (json.data.address || '') +
                        (json.data.status ? '<br><span style="opacity:.7">' + json.data.status + '</span>' : ''),
                        'is-found'
                    );
                } else {
                    setTaxResult('Không tìm thấy công ty ứng với mã số thuế này. Bạn vẫn có thể tiếp tục đặt hàng.', 'is-error');
                }
            })
            .catch(function () {
                setTaxResult('Không tra cứu được lúc này (lỗi mạng). Bạn vẫn có thể tiếp tục đặt hàng.', 'is-error');
            });
    }

    function bindEvents() {
        document.querySelectorAll('.quote-card__remove').forEach(function (btn) {
            btn.addEventListener('click', function () {
                state[btn.dataset.slug].checked = false;
                render();
            });
        });

        document.querySelectorAll('.qm-lock-split').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var slug = btn.dataset.slug;
                var maxLockNum = 0;
                activeSlugs().forEach(function (s) {
                    var m = /Khóa (\d+)/.exec(state[s].lock);
                    if (m) maxLockNum = Math.max(maxLockNum, parseInt(m[1], 10));
                });
                state[slug].lock = 'Khóa ' + (maxLockNum + 1);
                render();
            });
        });

        document.querySelectorAll('.qm-version').forEach(function (input) {
            input.addEventListener('change', function () {
                if (input.type === 'radio' && !input.checked) return;
                state[input.dataset.slug].version = input.value;
                render();
            });
        });

        document.addEventListener('change', function (e) {
            if (e.target.classList.contains('qm-lock')) {
                state[e.target.dataset.slug].lock = e.target.value;
                render();
            }
        });

        document.getElementById('btnCheckout').addEventListener('click', function () {
            document.getElementById('quoteCheckout').hidden = false;
            document.getElementById('quoteCheckout').scrollIntoView({ behavior: 'smooth', block: 'start' });
        });

        document.getElementById('btnBackToQuote').addEventListener('click', function () {
            document.getElementById('quoteCheckout').hidden = true;
        });

        document.getElementById('taxCodeInput').addEventListener('input', function (e) {
            clearTimeout(taxLookupTimer);
            var code = e.target.value.trim();
            if (!code) { setTaxResult(''); businessInfo = null; return; }
            taxLookupTimer = setTimeout(function () { lookupTaxCode(code); }, 500);
        });

        document.getElementById('checkoutForm').addEventListener('submit', function (e) {
            e.preventDefault();
            var result = calc();
            var data = Object.fromEntries(new FormData(e.target).entries());
            data.items = result.slugs.map(function (s) {
                return { slug: s, name: MODULES[s].name, version: state[s].version, lock: state[s].lock };
            });
            data.total = result.total;
            data.business = businessInfo;

            // TODO: gửi `data` tới endpoint xử lý đơn hàng thật (vd. /api/orders.php),
            // đồng thời đây là điểm phù hợp để tích hợp đăng nhập SĐT (src/lib/Auth.php)
            // trước khi cho khách xác nhận thanh toán.
            console.log('Đơn hàng báo giá:', data);

            e.target.hidden = true;
            var result_el = document.getElementById('checkoutResult');
            result_el.hidden = false;
            result_el.innerHTML = '<p style="margin-top:14px;">Cảm ơn bạn! Chúng tôi đã ghi nhận yêu cầu báo giá và sẽ liên hệ qua số điện thoại đã cung cấp để xác nhận thanh toán ' +
                (data.payment_method === 'qr' ? 'bằng mã QR' : 'chuyển khoản ngân hàng') + '.</p>';
        });
    }

    initState();
    bindEvents();
    render();
})();
</script>

<?php require __DIR__ . '/includes/footer.php'; ?>
