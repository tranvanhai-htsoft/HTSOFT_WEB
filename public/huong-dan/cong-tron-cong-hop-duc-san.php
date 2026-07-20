<?php
$pageTitle = 'Hướng dẫn — Cống Tròn & Cống Hộp Đúc Sẵn';
$pageDescription = 'Các bước sử dụng mô-đun Cống Tròn & Cống Hộp Đúc Sẵn 2026.';

// TODO(SV1): thay nội dung placeholder bằng video/GIF hướng dẫn thật cho từng bước, từng tình huống.

$scenarios = [
    'co-ban' => [
        'label' => 'Cống cơ bản',
        'steps' => [
            [
                'title' => 'Bước 1: Khởi tạo dự án',
                'desc'  => 'Vào File > New (hoặc Open) để mở file. Thiết lập tỷ lệ, vật liệu, font chữ, xuất bản vẽ và gia cố taluy.',
            ],
            [
                'title' => 'Bước 2: Nhận dữ liệu trắc ngang',
                'desc'  => 'Quét chọn trắc ngang từ nguồn (Nova, VnRoad, Civil 3D,...). Nhận từ tab trắc ngang và xuất sang tab bản vẽ cống làm cơ sở thiết kế.',
            ],
            [
                'title' => 'Bước 3: Thiết kế thân cống',
                'desc'  => 'Chọn loại cống, số dãy. Khai báo thông số hình học tại menu Thân cống. Xem trước, chỉnh số đốt/độ dốc xuất bản vẽ và Lưu khối lượng.',
            ],
            [
                'title' => 'Bước 4: Thiết kế thượng lưu',
                'desc'  => 'Chọn kết cấu phù hợp phía thượng lưu, hiệu chỉnh kích thước hoặc load file mẫu. Xuất bản vẽ, nhấn Lưu khối lượng sau khi hoàn thành.',
            ],
            [
                'title' => 'Bước 5: Thiết kế hạ lưu',
                'desc'  => 'Chọn kết cấu phù hợp phía hạ lưu, hiệu chỉnh kích thước hoặc load file mẫu. Xuất bản vẽ, nhấn Lưu khối lượng sau khi hoàn thành.',
            ],
            [
                'title' => 'Bước 6: Thiết kế móng thân cống',
                'desc'  => 'Thiết lập thông số, vẽ kết cấu móng thân cống phù hợp địa chất. Nhấn Lưu khối lượng.',
            ],
            [
                'title' => 'Bước 7: Xuất hồ sơ & Thuyết minh',
                'desc'  => 'Xuất bảng khối lượng chi tiết và thuyết minh thiết kế phục vụ lập hồ sơ, dự toán.',
            ],
            [
                'title' => 'Bước 8: Tổng hợp khối lượng sang Excel',
                'desc'  => 'Tự động gom dữ liệu toàn bộ hệ thống cống trong dự án và xuất file Excel để thống kê.',
            ],
        ],
    ],
    'do-thi-ho-ga' => [
        'label' => 'Cống đô thị kết hợp hố ga',
        'steps' => [
            [
                'title' => 'Bước 1: Khởi tạo dự án',
                'desc'  => 'Vào File > New (hoặc Open). Thiết lập tỷ lệ, vật liệu, font chữ, tùy chọn xuất bản vẽ và gia cố taluy.',
            ],
            [
                'title' => 'Bước 2: Nhận dữ liệu trắc ngang',
                'desc'  => 'Quét trắc ngang từ nguồn (Nova, VnRoad, Civil 3D,...). Nhận từ tab trắc ngang và xuất sang tab bản vẽ cống.',
            ],
            [
                'title' => 'Bước 3: Thiết kế hố ga',
                'desc'  => 'Chọn loại cống, nhập số dãy, khoảng cách dãy. Thiết lập đấu nối, vẽ hố ga tại vị trí chỉ định và Lưu khối lượng.',
            ],
            [
                'title' => 'Bước 4: Thiết kế thân cống',
                'desc'  => 'Mở cửa sổ Thân cống > chọn Cống đa phân đoạn. Xem trước, chỉnh số đốt/độ dốc từng phân đoạn, xuất bản vẽ và Lưu khối lượng.',
            ],
            [
                'title' => 'Bước 5: Thiết kế thượng lưu',
                'desc'  => 'Chọn kết cấu thượng lưu, chỉnh kích thước hoặc load file mẫu. Xuất bản vẽ và nhấn Lưu khối lượng.',
            ],
            [
                'title' => 'Bước 6: Thiết kế hạ lưu',
                'desc'  => 'Chọn kết cấu hạ lưu, chỉnh kích thước hoặc load file mẫu. Xuất bản vẽ và nhấn Lưu khối lượng.',
            ],
            [
                'title' => 'Bước 7: Thiết kế móng cống',
                'desc'  => 'Thiết lập thông số và vẽ kết cấu móng thân cống phù hợp địa chất. Nhấn Lưu khối lượng để cập nhật dữ liệu.',
            ],
            [
                'title' => 'Bước 8: Xuất hồ sơ & Thuyết minh',
                'desc'  => 'Xuất bảng khối lượng chi tiết và thuyết minh thiết kế hoàn chỉnh phục vụ công tác lập hồ sơ, dự toán.',
            ],
            [
                'title' => 'Bước 9: Tổng hợp khối lượng sang Excel',
                'desc'  => 'Tự động gom toàn bộ dữ liệu hệ thống cống trong dự án và xuất sang file Excel để kiểm tra, thống kê.',
            ],
        ],
    ],
    'mien-nui' => [
        'label' => 'Cống 2 dốc đường miền núi',
        'steps' => [
            [
                'title' => 'Bước 1: Khởi tạo dự án',
                'desc'  => 'Vào File > New (hoặc Open) để mở file. Thiết lập tỷ lệ, vật liệu, font chữ, xuất bản vẽ và gia cố taluy.',
            ],
            [
                'title' => 'Bước 2: Nhận dữ liệu trắc ngang',
                'desc'  => 'Quét chọn trắc ngang từ nguồn (Nova, VnRoad, Civil 3D,...). Nhận từ tab trắc ngang và xuất sang tab bản vẽ cống làm cơ sở thiết kế.',
            ],
            [
                'title' => 'Bước 3: Thiết kế thân cống',
                'desc'  => 'Chọn loại cống, số dãy. Mở cửa sổ thiết kế thân cống, chuyển qua tuỳ chọn cống 2 dốc. Xem trước, chỉnh số đốt/độ dốc xuất bản vẽ và lưu khối lượng.',
            ],
            [
                'title' => 'Bước 4: Thiết kế thượng lưu',
                'desc'  => 'Chọn kết cấu phù hợp phía thượng lưu, hiệu chỉnh kích thước hoặc load file mẫu. Xuất bản vẽ, nhấn Lưu khối lượng sau khi hoàn thành.',
            ],
            [
                'title' => 'Bước 5: Thiết kế hạ lưu',
                'desc'  => 'Chọn kết cấu phù hợp phía hạ lưu, hiệu chỉnh kích thước hoặc load file mẫu. Xuất bản vẽ, nhấn Lưu khối lượng sau khi hoàn thành.',
            ],
            [
                'title' => 'Bước 6: Thiết kế móng thân cống',
                'desc'  => 'Thiết lập thông số, vẽ kết cấu móng thân cống phù hợp địa chất. Nhấn Lưu khối lượng.',
            ],
            [
                'title' => 'Bước 7: Xuất hồ sơ & Thuyết minh',
                'desc'  => 'Xuất bảng khối lượng chi tiết và thuyết minh thiết kế phục vụ lập hồ sơ, dự toán.',
            ],
            [
                'title' => 'Bước 8: Tổng hợp khối lượng sang Excel',
                'desc'  => 'Tự động gom dữ liệu toàn bộ hệ thống cống trong dự án và xuất file Excel để thống kê.',
            ],
        ],
    ],
    'nang-cap-cai-tao' => [
        'label' => 'Cống nối đường nâng cấp cải tạo',
        'steps' => [
            [
                'title' => 'Bước 1: Khởi tạo dự án',
                'desc'  => 'Vào File > New (hoặc Open) để mở file. Thiết lập tỷ lệ, vật liệu, font chữ, xuất bản vẽ và gia cố taluy.',
            ],
            [
                'title' => 'Bước 2: Nhận dữ liệu trắc ngang',
                'desc'  => 'Quét chọn trắc ngang từ nguồn (Nova, VnRoad, Civil 3D,...). Nhận từ tab trắc ngang và xuất sang tab bản vẽ cống làm cơ sở thiết kế.',
            ],
            [
                'title' => 'Bước 3: Thiết kế thân cống',
                'desc'  => 'Chọn loại cống, số dãy. Mở cửa sổ thiết kế thân cống, chuyển qua tuỳ chọn cống nối. Xuất bản vẽ các phân đoạn nối và lưu khối lượng.',
            ],
            [
                'title' => 'Bước 4: Thiết kế thượng lưu',
                'desc'  => 'Chọn kết cấu phù hợp phía thượng lưu, hiệu chỉnh kích thước hoặc load file mẫu. Xuất bản vẽ, nhấn Lưu khối lượng sau khi hoàn thành.',
            ],
            [
                'title' => 'Bước 5: Thiết kế hạ lưu',
                'desc'  => 'Chọn kết cấu phù hợp phía hạ lưu, hiệu chỉnh kích thước hoặc load file mẫu. Xuất bản vẽ, nhấn Lưu khối lượng sau khi hoàn thành.',
            ],
            [
                'title' => 'Bước 6: Thiết kế móng thân cống',
                'desc'  => 'Thiết lập thông số, vẽ kết cấu móng thân cống phù hợp địa chất. Nhấn Lưu khối lượng.',
            ],
            [
                'title' => 'Bước 7: Xuất hồ sơ & Thuyết minh',
                'desc'  => 'Xuất bảng khối lượng chi tiết và thuyết minh thiết kế phục vụ lập hồ sơ, dự toán.',
            ],
            [
                'title' => 'Bước 8: Tổng hợp khối lượng sang Excel',
                'desc'  => 'Tự động gom dữ liệu toàn bộ hệ thống cống trong dự án và xuất file Excel để thống kê.',
            ],
        ],
    ],
];

$defaultScenario = array_key_first($scenarios);

require __DIR__ . '/../includes/header.php';
?>

<section>
    <span class="eyebrow">Hướng dẫn sử dụng</span>
    <h1 style="margin: 8px 0 10px; font-size: 1.9rem;"><?= htmlspecialchars($pageTitle) ?></h1>
    <p style="color: var(--text-muted); max-width: 60ch; margin-bottom: 24px;">
        Chọn tình huống sử dụng phù hợp với công trình của bạn, sau đó làm theo các bước. Bấm vào từng bước để xem chi tiết, không cần chuyển trang.
    </p>

    <div class="scenario-switch" role="tablist" aria-label="Chọn tình huống hướng dẫn">
        <?php foreach ($scenarios as $key => $scenario): ?>
        <button
            type="button"
            class="scenario-switch__btn<?= $key === $defaultScenario ? ' is-active' : '' ?>"
            data-scenario-target="<?= htmlspecialchars($key) ?>"
            role="tab"
            aria-selected="<?= $key === $defaultScenario ? 'true' : 'false' ?>"
        ><?= htmlspecialchars($scenario['label']) ?></button>
        <?php endforeach; ?>
    </div>

    <?php foreach ($scenarios as $key => $scenario): ?>
    <div
        class="guide-roadmap guide-scenario"
        data-scenario="<?= htmlspecialchars($key) ?>"
        style="<?= $key === $defaultScenario ? '' : 'display:none;' ?>"
    >
        <?php foreach ($scenario['steps'] as $i => $step): $n = $i + 1; ?>
        <div class="guide-step<?= $n === 1 ? ' is-open' : '' ?>">
            <button type="button" class="guide-step__marker">
                <span class="guide-step__num"><?= $n ?></span>
                <span class="guide-step__title"><?= htmlspecialchars($step['title']) ?></span>
            </button>
            <div class="guide-step__content">
                <p><?= htmlspecialchars($step['desc']) ?></p>
                <div class="guide-step__video">Video hướng dẫn 30 giây–2 phút chưa cập nhật</div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endforeach; ?>
</section>

<style>
    .scenario-switch {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 28px;
    }
    .scenario-switch__btn {
        padding: 9px 16px;
        border-radius: 999px;
        border: 1px solid var(--border, #ddd);
        background: transparent;
        color: var(--text-muted, #666);
        font-size: 0.92rem;
        cursor: pointer;
        transition: background 0.15s ease, color 0.15s ease, border-color 0.15s ease;
    }
    .scenario-switch__btn:hover {
        border-color: var(--accent, #2563eb);
        color: var(--text, #111);
    }
    .scenario-switch__btn.is-active {
        background: var(--accent, #2563eb);
        border-color: var(--accent, #2563eb);
        color: #fff;
    }
</style>

<script>
(function () {
    var switchButtons = document.querySelectorAll('.scenario-switch__btn');
    var scenarioPanels = document.querySelectorAll('.guide-scenario');

    switchButtons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            var target = btn.getAttribute('data-scenario-target');

            switchButtons.forEach(function (b) {
                var isActive = b === btn;
                b.classList.toggle('is-active', isActive);
                b.setAttribute('aria-selected', isActive ? 'true' : 'false');
            });

            scenarioPanels.forEach(function (panel) {
                panel.style.display = panel.getAttribute('data-scenario') === target ? '' : 'none';
            });
        });
    });
})();
</script>

<?php require __DIR__ . '/../includes/footer.php'; ?>
