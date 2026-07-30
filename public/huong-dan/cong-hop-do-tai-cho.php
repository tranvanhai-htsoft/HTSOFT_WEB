<?php
$pageTitle = 'Hướng dẫn — Cống Hộp Đổ Tại Chỗ';
$pageDescription = 'Các bước sử dụng mô-đun Cống Hộp Đổ Tại Chỗ 2026.';

// TODO(SV1): thay nội dung placeholder bằng video/GIF hướng dẫn thật cho từng bước, từng tình huống.
// Bạn chỉ cần điền 'video_url' cho từng bước (ví dụ: '/assets/videos/buoc-2.mp4') là video thật sẽ chạy ngay.

$scenarios = [
    'co-ban' => [
        'label' => 'Cống hộp cơ bản',
        'steps' => [
            [
                'title' => 'Bước 1: Mở file',
            ],
            [
                'title' => 'Bước 2: Nhập dữ liệu trắc ngang',
            ],
            [
                'title' => 'Bước 3: Gán thông số, thiết kế thân cống',
            ],
            [
                'title' => 'Bước 4: Thiết kế thượng lưu (Tường cánh bê tông cốt thép)',
            ],
            [
                'title' => 'Bước 5: Thiết kế hạ lưu',
            ],
            [
                'title' => 'Bước 6: Vẽ lan can',
            ],
            [
                'title' => 'Bước 7: Vẽ bản quá độ',
            ],
            [
                'title' => 'Bước 8: Xuất hồ sơ và thuyết minh',
            ],
            [
                'title' => 'Bước 9: Tổng hợp khối lượng qua Excel',
            ],
        ],
    ],
    'xien' => [
        'label' => 'Cống hộp xiên',
        'steps' => [
            [
                'title' => 'Bước 1: Mở file',
            ],
            [
                'title' => 'Bước 2: Nhập dữ liệu trắc ngang',
            ],
            [
                'title' => 'Bước 3: Gán thông số, thiết kế thân cống',
            ],
            [
                'title' => 'Bước 4: Thiết kế thượng lưu (Tường cánh bê tông cốt thép)',
            ],
            [
                'title' => 'Bước 5: Thiết kế hạ lưu',
            ],
            [
                'title' => 'Bước 6: Vẽ lan can',
            ],
            [
                'title' => 'Bước 7: Vẽ bản quá độ',
            ],
            [
                'title' => 'Bước 8: Xuất hồ sơ và thuyết minh',
            ],
            [
                'title' => 'Bước 9: Tổng hợp khối lượng qua Excel',
            ],
        ],
    ],
    'chui' => [
        'label' => 'Cống hộp chui',
        'steps' => [
            [
                'title' => 'Bước 1: Mở file',
            ],
            [
                'title' => 'Bước 2: Nhập dữ liệu trắc ngang',
            ],
            [
                'title' => 'Bước 3: Thiết kế thân cống đổ tại chỗ',
            ],
            [
                'title' => 'Bước 4: Thiết kế tường cánh tứ nón thượng hạ lưu',
            ],
            [
                'title' => 'Bước 5: Hoàn thiện kết cấu',
            ],
            [
                'title' => 'Bước 6: Vẽ bản giảm tải đổ tại chỗ',
            ],
            [
                'title' => 'Bước 7: Vẽ lan can tay vịn',
            ],
            [
                'title' => 'Bước 8: Xuất hồ sơ và thuyết minh',
            ],
            [
                'title' => 'Bước 9: Tổng hợp khối lượng qua Excel',
            ],
        ],
    ],
    'duong-gom' => [
        'label' => 'Cống hộp đường gom',
        'steps' => [
            [
                'title' => 'Bước 1: Mở file',
            ],
            [
                'title' => 'Bước 2: Nhập dữ liệu trắc ngang',
            ],
            [
                'title' => 'Bước 3: Thiết kế thân cống chính',
            ],
            [
                'title' => 'Bước 4: Thiết kế thượng hạ lưu cống chính',
            ],
            [
                'title' => 'Bước 5: Thiết kế thân cống đường gom trái',
            ],
            [
                'title' => 'Bước 6: Thiết kế thượng hạ lưu cống đường gom trái',
            ],
            [
                'title' => 'Bước 7: Thiết kế thân cống đường gom phải',
            ],
            [
                'title' => 'Bước 8: Thiết kế thượng hạ lưu cống đường gom phải',
            ],
            [
                'title' => 'Bước 9: Xuất khối lượng và thuyết minh',
            ],
            [
                'title' => 'Bước 10: Tổng hợp khối lượng qua Excel',
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
