<?php
require __DIR__ . '/../includes/config.php';

$pageTitle = 'Hướng dẫn — Cầu Bản – Cống Bản – Tràn Liên Hợp';
$pageDescription = 'Các bước sử dụng mô-đun Cầu Bản – Cống Bản – Tràn Liên Hợp ' . MODULE_YEAR . '.';

// TODO(SV1): thay nội dung placeholder bằng video/GIF hướng dẫn thật cho từng bước, từng tình huống.
// Bạn chỉ cần điền 'video_url' cho từng bước (ví dụ: '/assets/videos/buoc-2.mp4') là video thật sẽ chạy ngay.

$scenarios = [
    'co-ban-69-34x' => [
        'label' => 'Cầu bản cơ bản định hình 69-34X',
        'steps' => [
            [
                'title' => 'Bước 1: Mở file',
            ],
            [
                'title' => 'Bước 2: Nhập dữ liệu trắc ngang',
            ],
            [
                'title' => 'Bước 3: Thiết kế nhịp cầu dầm bản lắp ghép',
            ],
            [
                'title' => 'Bước 4: Thiết kế thượng lưu (hoặc hạ lưu)',
            ],
            [
                'title' => 'Bước 5: Thiết kế hạ lưu (hoặc thượng lưu)',
            ],
            [
                'title' => 'Bước 6: Xuất khối lượng và thuyết minh',
            ],
            [
                'title' => 'Bước 7: Tổng hợp khối lượng qua Excel',
            ],
        ],
    ],
    'cong-ban-noi' => [
        'label' => 'Cống bản nối',
        'steps' => [
            [
                'title' => 'Bước 1: Mở file',
            ],
            [
                'title' => 'Bước 2: Nhập dữ liệu trắc ngang',
            ],
            [
                'title' => 'Bước 3: Thiết kế phân đoạn nối thứ nhất',
            ],
            [
                'title' => 'Bước 4: Thiết kế phân đoạn nối thứ hai',
            ],
            [
                'title' => 'Bước 5: Thiết kế thượng lưu (hoặc hạ lưu)',
            ],
            [
                'title' => 'Bước 6: Thiết kế hạ lưu (hoặc thượng lưu)',
            ],
            [
                'title' => 'Bước 7: Xuất khối lượng và thuyết minh',
            ],
            [
                'title' => 'Bước 8: Tổng hợp khối lượng qua Excel',
            ],
        ],
    ],
    'cong-ban-xien' => [
        'label' => 'Cống bản xiên',
        'steps' => [
            [
                'title' => 'Bước 1: Mở file',
            ],
            [
                'title' => 'Bước 2: Nhập dữ liệu trắc ngang',
            ],
            [
                'title' => 'Bước 3: Thiết kế thân cống',
            ],
            [
                'title' => 'Bước 4: Thiết kế thượng lưu (hoặc hạ lưu)',
            ],
            [
                'title' => 'Bước 5: Thiết kế hạ lưu (hoặc thượng lưu)',
            ],
            [
                'title' => 'Bước 6: Xuất khối lượng và thuyết minh',
            ],
        ],
    ],
    'dam-ban-hl93' => [
        'label' => 'Cầu bản dầm đổ tại chỗ tải trọng 0.65HL93',
        'steps' => [
            [
                'title' => 'Bước 1: Mở file',
            ],
            [
                'title' => 'Bước 2: Nhập lý trình cầu và chọn mẫu cầu',
            ],
            [
                'title' => 'Bước 3: Nhập dữ liệu trắc dọc',
            ],
            [
                'title' => 'Bước 4: Thiết kế nhịp cầu dầm bản',
            ],
            [
                'title' => 'Bước 5: Thiết kế trụ cầu (đối với cầu đa nhịp)',
            ],
            [
                'title' => 'Bước 6: Xuất khối lượng và thuyết minh',
            ],
            [
                'title' => 'Bước 7: Tổng hợp khối lượng qua Excel',
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
                <div class="guide-step__video">
                    <?php if (!empty($step['video_url'])): ?>
                        <video controls preload="auto" width="100%" style="border-radius: 8px; max-height: 450px; background: #000; display: block; margin-top: 12px;">
                            <source src="<?= htmlspecialchars($step['video_url']) ?>" type="video/mp4">
                            Trình duyệt của bạn không hỗ trợ phát video này.
                        </video>
                    <?php else: ?>
                        <div style="padding: 20px; background: #f9f9f9; border: 1px dashed #ddd; border-radius: 8px; text-align: center; color: #888; font-style: italic; margin-top: 12px;">
                            Video hướng dẫn đang được cập nhật...
                        </div>
                    <?php endif; ?>
                </div>
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
