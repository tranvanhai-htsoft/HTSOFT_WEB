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
        'icon' => '🔵',
        'versions' => [
            ['id' => 'standard', 'label' => 'Tiêu chuẩn', 'price' => 3600000, 'available' => true],
            ['id' => 'full', 'label' => 'Full nâng cao', 'price' => 4900000, 'available' => true],
        ],
    ],
    'cau-ban-cong-ban-tran-lien-hop' => [
        'name' => 'Mô-đun 3: Cầu Bản – Cống Bản – Tràn Liên Hợp ' . MODULE_YEAR,
        'icon' => '🔵',
        'versions' => [
            ['id' => 'standard', 'label' => 'Tiêu chuẩn', 'price' => 3600000, 'available' => true],
            ['id' => 'full', 'label' => 'Full nâng cao', 'price' => 0, 'available' => false],
        ],
    ],
    'thiet-ke-ho-ga' => [
        'name' => 'Mô-đun 4: Thiết Kế Hố Ga ' . MODULE_YEAR,
        'icon' => '🔵',
        'versions' => [
            ['id' => 'standard', 'label' => 'Cơ sở', 'price' => 2600000, 'available' => true],
        ],
    ],
    'thiet-ke-cau-gian-don' => [
        'name' => 'Mô-đun 5: Thiết Kế Cầu Giản Đơn BTCT DƯL ' . MODULE_YEAR,
        'icon' => '🔵',
        'versions' => [
            ['id' => 'standard', 'label' => 'Cơ sở', 'price' => 5900000, 'available' => true],
        ],
    ],
    'kiem-toan-cau-gian-don' => [
        'name' => 'Mô-đun 6: Kiểm Toán Cầu Giản Đơn ' . MODULE_YEAR,
        'icon' => '🔵',
        'versions' => [
            ['id' => 'standard', 'label' => 'Cơ sở', 'price' => 2900000, 'available' => true],
        ],
    ],
    'kiem-toan-cau-ban' => [
        'name' => 'Mô-đun 7: Kiểm Toán Cầu Bản ' . MODULE_YEAR,
        'icon' => '🔵',
        'versions' => [
            ['id' => 'standard', 'label' => 'Cơ sở', 'price' => 2900000, 'available' => true],
        ],
    ],
    'kiem-toan-cong-hop' => [
        'name' => 'Mô-đun 8: Kiểm Toán Cống Hộp ' . MODULE_YEAR,
        'icon' => '🔵',
        'versions' => [
            ['id' => 'standard', 'label' => 'Cơ sở', 'price' => 2900000, 'available' => true],
        ],
    ],
];

$modulesJson = json_encode($modules, JSON_UNESCAPED_UNICODE);
$lockFeeJson = json_encode($LOCK_FEE);

require __DIR__ . '/includes/header.php';
?>

<section>
    <h1 style="margin: 8px 0 8px; font-size: 1.9rem;">Bộ Tính Báo Giá</h1>
    <p class="card-3d__desc" style="max-width: 640px; margin-bottom: 28px;">
        Tích chọn các mô-đun cần dùng, chọn phiên bản và gán khóa tích hợp — hệ thống sẽ tự
        động cập nhật tổng tiền theo thời gian thực.
    </p>

    <div class="quote-layout">
        <!-- ===================== MAIN PANEL: CHỌN MÔ-ĐUN + TRỰC QUAN HOÁ KHÓA ===================== -->
        <div class="main-panel">
            <h2 class="panel-heading">1. Chọn Cấu Hình Mô-đun Phần Mềm</h2>
            <div id="moduleList">
                <?php foreach ($modules as $slug => $m): ?>
                <div class="module-item" data-slug="<?= htmlspecialchars($slug) ?>">
                    <div class="module-row-top">
                        <span class="module-icon"><?= $m['icon'] ?></span>
                        <span class="module-name"><?= htmlspecialchars($m['name']) ?></span>
                        <div class="options">
                            <button type="button" class="btn-opt active" id="btn-<?= htmlspecialchars($slug) ?>-0" data-slug="<?= htmlspecialchars($slug) ?>" data-opt="0">Không mua</button>
                            <?php foreach ($m['versions'] as $i => $v): ?>
                            <button type="button" class="btn-opt<?= !$v['available'] ? ' is-disabled' : '' ?>"
                                    id="btn-<?= htmlspecialchars($slug) ?>-<?= $i + 1 ?>"
                                    data-slug="<?= htmlspecialchars($slug) ?>" data-opt="<?= $i + 1 ?>"
                                    <?= !$v['available'] ? 'disabled' : '' ?>>
                                <?= htmlspecialchars($v['label']) ?>
                                (<?= $v['available'] ? number_format($v['price'], 0, ',', '.') . 'đ' : 'chưa phát hành' ?>)
                            </button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="key-assign-zone" id="key-zone-<?= htmlspecialchars($slug) ?>" style="display:none;">
                        <span>Cài đặt bản quyền: Tích hợp mô-đun này vào </span>
                        <select class="key-select" id="select-key-<?= htmlspecialchars($slug) ?>" data-slug="<?= htmlspecialchars($slug) ?>"></select>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <h2 class="panel-heading">2. Danh Sách Thiết Bị Khóa Bàn Giao</h2>
            <div class="key-summary-box">
                <div id="keyVisualList">Chưa có mô-đun nào được chọn.</div>
            </div>
        </div>

        <!-- ===================== SIDE PANEL: BÁO GIÁ CHI TIẾT ===================== -->
        <aside class="side-panel">
            <h2 class="panel-heading">Báo Giá Chi Tiết</h2>
            <div class="summary-line"><span>Mô-đun đã chọn:</span> <span id="res-count">0</span></div>
            <div class="summary-line"><span>Tổng giá cơ sở:</span> <span id="res-base">0đ</span></div>
            <div class="summary-line"><span>Giảm giá số lượng:</span> <span id="res-discount-qty" class="discount">-0đ</span></div>
            <div class="summary-line"><span>Tiết kiệm gộp khóa:</span> <span id="res-discount-key" class="discount">-0đ</span></div>
            <div class="summary-line summary-line--split"><span>Số khóa thực tế cần giao:</span> <span id="res-key-count">0 khóa</span></div>
            <div class="total-line"><span>TỔNG CỘNG:</span> <span id="res-total">0đ</span></div>
            <div style="display:flex; gap:10px; margin-top:16px;">
                <button type="button" class="btn-3d btn-3d-yellow" id="btnCheckout" style="flex:1; padding-left:12px; padding-right:12px; white-space:nowrap;">Thanh toán</button>
                <button type="button" class="btn-3d btn-3d-blue" id="btnDownloadQuote" style="flex:1; padding-left:12px; padding-right:12px; white-space:nowrap;">Tải báo giá</button>
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
.quote-layout { display: grid; grid-template-columns: 1fr 400px; gap: 24px; align-items: start; }
@media (max-width: 860px) { .quote-layout { grid-template-columns: 1fr; } }

.main-panel, .side-panel { background: var(--surface, #fff); border: var(--border-width, 2px) solid var(--ink, #111); border-radius: var(--radius, 12px); padding: 20px 22px; }
.side-panel { position: sticky; top: 20px; }
.panel-heading { margin: 0 0 16px; font-size: 1.1rem; border-bottom: 2px solid rgba(0,0,0,0.08); padding-bottom: 10px; }
.main-panel .panel-heading:not(:first-child) { margin-top: 24px; }

.module-item { padding: 14px 0; border-bottom: 1px solid rgba(0,0,0,0.08); display: flex; flex-direction: column; gap: 10px; }
.module-item:last-child { border-bottom: none; }
.module-row-top { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
.module-icon { font-size: 1.2rem; }
.module-name { font-weight: 700; flex: 1; min-width: 160px; }
.options { display: flex; gap: 8px; flex-wrap: wrap; }
.btn-opt { padding: 8px 14px; border: 1px solid rgba(0,0,0,0.2); background: #fff; cursor: pointer; border-radius: 6px; font-size: 0.82rem; transition: all 0.15s ease; }
.btn-opt.active { background: var(--htsoft-blue, #0091FF); color: #fff; border-color: var(--htsoft-blue, #0091FF); font-weight: 700; }
.btn-opt.is-disabled { opacity: 0.45; cursor: not-allowed; }

.key-assign-zone { display: flex; align-items: center; flex-wrap: wrap; gap: 8px 10px; background: rgba(0,0,0,0.03); padding: 8px 12px; border-radius: 6px; font-size: 0.85rem; }
.key-assign-zone span { flex: 1 1 220px; min-width: 0; }
.key-select { flex-shrink: 0; padding: 4px 8px; border-radius: 4px; border: 1px solid rgba(0,0,0,0.2); font-weight: 700; background: #fff; cursor: pointer; }

.key-summary-box { padding: 15px; background: rgba(0,0,0,0.03); border-radius: 8px; }
.key-group { margin-bottom: 12px; }
.key-group:last-child { margin-bottom: 0; }
.key-group__label { font-size: 0.82rem; font-weight: 700; margin-bottom: 6px; }
.key-badge { display: inline-block; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; color: #fff; margin: 0 6px 6px 0; }

.summary-line { display: flex; justify-content: space-between; margin-bottom: 14px; font-size: 0.92rem; }
.summary-line--split { border-top: 1px dashed rgba(0,0,0,0.15); padding-top: 10px; }
.summary-line .discount { color: #2e7d32; font-weight: 700; }
.total-line { display: flex; justify-content: space-between; margin-top: 6px; padding-top: 14px; border-top: 2px solid var(--ink, #111); font-size: 1.3rem; font-weight: 700; color: var(--danger-red, #E5484D); }

.quote-form { display: grid; grid-template-columns: 1fr 1fr; gap: 12px 16px; margin-top: 12px; }
.quote-form label { display: flex; flex-direction: column; gap: 6px; font-size: 0.88rem; }
.quote-form input, .quote-form textarea { padding: 9px 10px; border-radius: 8px; border: 1px solid rgba(0,0,0,0.2); background: #ffffff; color: #1b1b22; }
.quote-form__full { grid-column: 1 / -1; }
.quote-form__total { font-size: 1.05rem; text-align: right; }
.quote-field__label { font-size: 0.82rem; opacity: 0.7; }
.quote-versions { display: flex; flex-wrap: wrap; gap: 10px; }
.quote-version { display: flex; align-items: center; gap: 8px; border: 1px solid rgba(0,0,0,0.15); border-radius: 10px; padding: 8px 12px; cursor: pointer; font-size: 0.88rem; }
.quote-checkout { margin-top: 26px; }

.tax-lookup { font-size: 0.85rem; padding: 10px 12px; border-radius: 8px; border: 1px solid rgba(0,0,0,0.12); background: rgba(0,0,0,0.03); margin-top: -4px; }
.tax-lookup.is-loading { opacity: 0.7; }
.tax-lookup.is-found { border-color: #2e7d32; background: rgba(46,125,50,0.08); }
.tax-lookup.is-error { border-color: #f05431; background: rgba(240,84,49,0.08); }
</style>

<script>
(function () {
    var MODULES = <?= $modulesJson ?>; // slug -> { name, icon, versions: [{id,label,price,available}] }
    var LOCK_FEE = <?= $lockFeeJson ?>;
    var STORAGE_KEY = 'druong_selected_modules'; // đọc/ghi chung với nút "Chọn mua" ở index.php

    // Bảng màu cố định cho tối đa 8 khóa cứng riêng biệt.
    var KEY_COLORS = ['#E63946', '#457B9D', '#2A9D8F', '#F4A261', '#9B5DE5', '#F15BB5', '#00A0B0', '#3182CE'];

    var slugs = Object.keys(MODULES);
    var selections = {}; // slug -> 0 (không mua) | 1..N (chỉ số phiên bản đã chọn)
    var assignedKeys = {}; // slug -> slug của mô-đun giữ khóa vật lý (mặc định là chính nó)
    var businessInfo = null; // kết quả tra cứu công ty theo mã số thuế, gửi kèm khi đặt hàng
    var taxLookupTimer = null;
    var lastResult = { n: 0, total: 0 };

    function fmt(n) {
        return Math.round(n).toLocaleString('vi-VN') + 'đ';
    }

    function setText(id, text) {
        var el = document.getElementById(id);
        if (el) el.textContent = text;
    }

    function getInitialSlugs() {
        var initial = [];
        try {
            var params = new URLSearchParams(window.location.search);
            if (params.get('modules')) initial = params.get('modules').split(',');
        } catch (e) {}
        if (!initial.length) {
            try {
                var raw = localStorage.getItem(STORAGE_KEY);
                if (raw) initial = JSON.parse(raw);
            } catch (e) {}
        }
        return initial.filter(function (s) { return MODULES.hasOwnProperty(s); });
    }

    function persistSelection() {
        var selected = slugs.filter(function (s) { return selections[s] > 0; });
        try { localStorage.setItem(STORAGE_KEY, JSON.stringify(selected)); } catch (e) {}
    }

    // Chọn mua từ trang chủ (mô-đun 1-2-3 có bản Full nâng cao đã phát hành) thì mặc định
    // gán bản cao nhất đang bán; mô-đun chỉ có 1 bản (4-8) thì đó luôn là bản duy nhất.
    function defaultOptIndexFor(slug) {
        var versions = MODULES[slug].versions;
        for (var i = versions.length; i >= 1; i--) {
            if (versions[i - 1].available) return i;
        }
        return 1;
    }

    function selectOpt(slug, optValue) {
        selections[slug] = optValue;
        var maxOpt = MODULES[slug].versions.length;

        for (var i = 0; i <= maxOpt; i++) {
            var btn = document.getElementById('btn-' + slug + '-' + i);
            if (btn) btn.classList.remove('active');
        }
        var activeBtn = document.getElementById('btn-' + slug + '-' + optValue);
        if (activeBtn) activeBtn.classList.add('active');

        var zone = document.getElementById('key-zone-' + slug);
        if (zone) {
            if (optValue > 0) {
                zone.style.display = 'flex';
            } else {
                zone.style.display = 'none';
                assignedKeys[slug] = slug;
            }
        }

        updateDropdownOptions();
        calculatePrice();
    }

    function updateDropdownOptions() {
        var activeSlugs = slugs.filter(function (s) { return selections[s] > 0; });

        slugs.forEach(function (slug) {
            if (selections[slug] <= 0) return;
            var selectEl = document.getElementById('select-key-' + slug);
            if (!selectEl) return;

            var current = assignedKeys[slug];
            selectEl.innerHTML = '';
            activeSlugs.forEach(function (activeSlug) {
                var opt = document.createElement('option');
                opt.value = activeSlug;
                opt.text = 'Khóa của ' + MODULES[activeSlug].name;
                if (activeSlug === current) opt.selected = true;
                selectEl.appendChild(opt);
            });

            if (activeSlugs.indexOf(current) === -1) {
                assignedKeys[slug] = slug;
                selectEl.value = slug;
            }
        });
    }

    function changeModuleKey(slug, targetSlug) {
        assignedKeys[slug] = targetSlug;
        calculatePrice();
    }

    function calculatePrice() {
        var selectedCount = 0;
        var totalBasePrice = 0;
        var activeKeysSet = {};
        var activeSlugs = [];

        slugs.forEach(function (slug) {
            var opt = selections[slug];
            if (opt > 0) {
                selectedCount++;
                activeSlugs.push(slug);
                totalBasePrice += MODULES[slug].versions[opt - 1].price;
                activeKeysSet[assignedKeys[slug]] = true;
            }
        });

        var discountPerModule = 0;
        if (selectedCount === 2) discountPerModule = 100000;
        else if (selectedCount >= 3 && selectedCount <= 10) discountPerModule = 300000;
        else if (selectedCount > 10) discountPerModule = 500000;
        var totalQtyDiscount = discountPerModule * selectedCount;

        var actualKeyCount = Object.keys(activeKeysSet).length;
        var savedKeys = selectedCount - actualKeyCount;
        var totalKeyDiscount = savedKeys * LOCK_FEE;

        var finalTotal = totalBasePrice - totalQtyDiscount - totalKeyDiscount;
        lastResult = {
            n: selectedCount,
            total: finalTotal,
            slugs: activeSlugs,
            subtotal: totalBasePrice,
            qtyDiscount: totalQtyDiscount,
            keyDiscount: totalKeyDiscount,
            keyCount: actualKeyCount,
        };

        setText('res-count', selectedCount);
        setText('res-base', fmt(totalBasePrice));
        setText('res-discount-qty', '-' + fmt(totalQtyDiscount));
        setText('res-discount-key', '-' + fmt(totalKeyDiscount));
        setText('res-key-count', actualKeyCount + ' khóa');
        setText('res-total', fmt(finalTotal));
        setText('checkoutTotal', fmt(finalTotal));

        renderKeyVisual(activeSlugs);
        persistSelection();
    }

    // Trực quan hoá khóa cứng: gom mô-đun đang chọn theo khóa vật lý đã gán, tô màu theo
    // nhóm để khách thấy rõ sẽ nhận bao nhiêu thiết bị khóa và mô-đun nào đi kèm khóa nào.
    function renderKeyVisual(activeSlugs) {
        slugs.forEach(function (s) {
            var zone = document.getElementById('key-zone-' + s);
            if (zone) zone.style.borderLeft = 'none';
        });

        var list = document.getElementById('keyVisualList');
        if (activeSlugs.length === 0) {
            list.innerHTML = 'Chưa có mô-đun nào được chọn.';
            return;
        }

        var holders = [];
        activeSlugs.forEach(function (s) {
            if (holders.indexOf(assignedKeys[s]) === -1) holders.push(assignedKeys[s]);
        });

        list.innerHTML = '';
        holders.forEach(function (holder, idx) {
            var members = activeSlugs.filter(function (s) { return assignedKeys[s] === holder; });
            if (!members.length) return;
            var color = KEY_COLORS[idx % KEY_COLORS.length];

            var group = document.createElement('div');
            group.className = 'key-group';
            var badgesHTML = members.map(function (s) {
                return '<span class="key-badge" style="background:' + color + '">' + MODULES[s].name + '</span>';
            }).join('');
            group.innerHTML = '<div class="key-group__label">📦 Bộ khóa cứng thứ ' + (idx + 1) + ':</div><div>' + badgesHTML + '</div>';
            list.appendChild(group);

            members.forEach(function (s) {
                var zone = document.getElementById('key-zone-' + s);
                if (zone) zone.style.borderLeft = '4px solid ' + color;
            });
        });
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

    // Nhãn "Bộ khóa cứng thứ N" cho từng mô-đun, khớp đúng thứ tự hiện ở khu vực
    // trực quan hoá khóa — dùng chung khi xuất file báo giá Word.
    function buildKeyGroupLabels(activeSlugs) {
        var holders = [];
        activeSlugs.forEach(function (s) {
            if (holders.indexOf(assignedKeys[s]) === -1) holders.push(assignedKeys[s]);
        });
        var labelByHolder = {};
        holders.forEach(function (h, idx) { labelByHolder[h] = 'Bộ khóa cứng thứ ' + (idx + 1); });

        var labelBySlug = {};
        activeSlugs.forEach(function (s) { labelBySlug[s] = labelByHolder[assignedKeys[s]]; });
        return labelBySlug;
    }

    // Xuất báo giá ra file Word (.doc) — dùng kỹ thuật HTML-as-Word (không cần thư viện
    // ngoài), có header/footer công ty theo đúng mẫu letterhead công ty cung cấp.
    function downloadQuoteDoc() {
        if (lastResult.n === 0) {
            alert('Vui lòng chọn ít nhất 1 mô-đun trước khi tải báo giá.');
            return;
        }

        var keyLabels = buildKeyGroupLabels(lastResult.slugs);
        var today = new Date().toLocaleDateString('vi-VN');
        var td = 'style="border:1px solid #000; padding:6px;"';

        var rows = lastResult.slugs.map(function (s, i) {
            var v = MODULES[s].versions[selections[s] - 1];
            return '<tr>' +
                '<td ' + td + ' align="center">' + (i + 1) + '</td>' +
                '<td ' + td + '>' + MODULES[s].name + '</td>' +
                '<td ' + td + '>' + v.label + '</td>' +
                '<td ' + td + '>' + keyLabels[s] + '</td>' +
                '<td ' + td + ' align="right">' + fmt(v.price) + '</td>' +
                '</tr>';
        }).join('');

        var html = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:w="urn:schemas-microsoft-com:office:word" xmlns="http://www.w3.org/TR/REC-html40">' +
            '<head><meta charset="utf-8"><title>Báo giá Dradnet</title></head>' +
            '<body style="font-family: Arial, sans-serif; font-size: 13px; color: #000;">' +

            '<table width="100%" style="border-collapse:collapse; margin-bottom:6px;"><tr>' +
                '<td style="font-size:22px; font-weight:bold; white-space:nowrap; vertical-align:middle;">' +
                    '<span style="color:#E8720C;">HT</span><span style="color:#0057B8;">SOFT</span>' +
                '</td>' +
                '<td style="font-size:13px; padding-left:24px; vertical-align:middle;">CÔNG TY CP PHẦN MỀM CTGT HẢI THANH &ndash; MST 0305777626</td>' +
            '</tr></table>' +
            '<div style="border-top:3px double #000; margin:0 0 24px;"></div>' +

            '<h2 style="text-align:center; margin:0 0 4px;">BÁO GIÁ SẢN PHẨM PHẦN MỀM DRADNET</h2>' +
            '<p style="text-align:center; margin:0 0 20px; font-style:italic;">Ngày ' + today + '</p>' +

            '<table width="100%" style="border-collapse:collapse; border:1px solid #000; margin-bottom:16px;">' +
                '<tr style="background:#f0f0f0; font-weight:bold;">' +
                    '<td ' + td + ' align="center">STT</td>' +
                    '<td ' + td + '>Mô-đun</td>' +
                    '<td ' + td + '>Phiên bản</td>' +
                    '<td ' + td + '>Khóa gán</td>' +
                    '<td ' + td + ' align="right">Đơn giá</td>' +
                '</tr>' +
                rows +
            '</table>' +

            '<table width="100%" style="border-collapse:collapse; margin-bottom:24px;">' +
                '<tr><td style="padding:3px 0;">Tổng giá cơ sở</td><td align="right" style="padding:3px 0;">' + fmt(lastResult.subtotal) + '</td></tr>' +
                '<tr><td style="padding:3px 0;">Giảm giá số lượng</td><td align="right" style="padding:3px 0;">-' + fmt(lastResult.qtyDiscount) + '</td></tr>' +
                '<tr><td style="padding:3px 0;">Tiết kiệm gộp khóa (' + lastResult.keyCount + ' khóa thực giao)</td><td align="right" style="padding:3px 0;">-' + fmt(lastResult.keyDiscount) + '</td></tr>' +
                '<tr style="font-weight:bold; font-size:15px;"><td style="padding-top:8px; border-top:1px solid #000;">TỔNG CỘNG</td><td align="right" style="padding-top:8px; border-top:1px solid #000;">' + fmt(lastResult.total) + '</td></tr>' +
            '</table>' +

            '<div style="border-top:3px double #000; margin:40px 0 6px;"></div>' +
            '<p style="margin:0;">www.Dradnet.vn&nbsp;&nbsp;&nbsp;Trụ sở : Tòa nhà SBI, khu phần mềm Quang Trung, Trung Mỹ Tây, TP HCM</p>' +
            '<p style="margin:0; text-align:right;">Tel : 0905.887.868</p>' +

            '</body></html>';

        var blob = new Blob(['﻿', html], { type: 'application/msword' });
        var url = URL.createObjectURL(blob);
        var a = document.createElement('a');
        a.href = url;
        a.download = 'bao-gia-dradnet-' + Date.now() + '.doc';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        setTimeout(function () { URL.revokeObjectURL(url); }, 1000);
    }

    function bindEvents() {
        document.querySelectorAll('.btn-opt').forEach(function (btn) {
            if (btn.disabled) return;
            btn.addEventListener('click', function () {
                selectOpt(btn.dataset.slug, parseInt(btn.dataset.opt, 10));
            });
        });

        document.addEventListener('change', function (e) {
            if (e.target.classList.contains('key-select')) {
                changeModuleKey(e.target.dataset.slug, e.target.value);
            }
        });

        document.getElementById('btnCheckout').addEventListener('click', function () {
            if (lastResult.n === 0) {
                alert('Vui lòng chọn ít nhất 1 mô-đun trước khi thanh toán.');
                return;
            }
            document.getElementById('quoteCheckout').hidden = false;
            document.getElementById('quoteCheckout').scrollIntoView({ behavior: 'smooth', block: 'start' });
        });

        document.getElementById('btnBackToQuote').addEventListener('click', function () {
            document.getElementById('quoteCheckout').hidden = true;
        });

        document.getElementById('btnDownloadQuote').addEventListener('click', downloadQuoteDoc);

        document.getElementById('taxCodeInput').addEventListener('input', function (e) {
            clearTimeout(taxLookupTimer);
            var code = e.target.value.trim();
            if (!code) { setTaxResult(''); businessInfo = null; return; }
            taxLookupTimer = setTimeout(function () { lookupTaxCode(code); }, 500);
        });

        document.getElementById('checkoutForm').addEventListener('submit', function (e) {
            e.preventDefault();
            var data = Object.fromEntries(new FormData(e.target).entries());
            data.items = lastResult.slugs.map(function (s) {
                return {
                    slug: s,
                    name: MODULES[s].name,
                    version: MODULES[s].versions[selections[s] - 1].label,
                    key_group: assignedKeys[s],
                };
            });
            data.total = lastResult.total;
            data.business = businessInfo;

            // TODO: gửi `data` tới endpoint xử lý đơn hàng thật (vd. /api/orders.php),
            // đồng thời đây là điểm phù hợp để tích hợp đăng nhập SĐT (src/lib/Auth.php)
            // trước khi cho khách xác nhận thanh toán.
            console.log('Đơn hàng báo giá:', data);

            e.target.hidden = true;
            var resultEl = document.getElementById('checkoutResult');
            resultEl.hidden = false;
            resultEl.innerHTML = '<p style="margin-top:14px;">Cảm ơn bạn! Chúng tôi đã ghi nhận yêu cầu báo giá và sẽ liên hệ qua số điện thoại đã cung cấp để xác nhận thanh toán ' +
                (data.payment_method === 'qr' ? 'bằng mã QR' : 'chuyển khoản ngân hàng') + '.</p>';
        });
    }

    function init() {
        slugs.forEach(function (slug) {
            selections[slug] = 0;
            assignedKeys[slug] = slug;
        });

        bindEvents();

        // Mô-đun đã "Chọn mua" từ trang chủ (đồng bộ qua localStorage) thì tự chọn sẵn
        // bản phù hợp ở đây, không cần khách bấm lại.
        getInitialSlugs().forEach(function (slug) {
            selectOpt(slug, defaultOptIndexFor(slug));
        });

        calculatePrice();
    }

    init();
})();
</script>

<?php require __DIR__ . '/includes/footer.php'; ?>
