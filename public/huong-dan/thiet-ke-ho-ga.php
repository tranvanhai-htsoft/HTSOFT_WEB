<?php
require __DIR__ . '/../includes/config.php';

$pageTitle = 'Thiết Kế Hố Ga';
$pageDescription = 'Các bước sử dụng mô-đun Thiết Kế Hố Ga ' . MODULE_YEAR . '.';

// Ghi chú: 4 tình huống dưới đây có cùng 4 bước — đây là quy trình chung áp dụng cho mọi loại hố ga,
// mỗi tình huống lấy video từ thư mục riêng trong public/images/.

function hoGaSteps($folder) {
    return [
        [
            'title' => 'Bước 1: Thiết lập tham số hệ thống',
            'video_url' => "/images/$folder/B1.mp4",
        ],
        [
            'title' => 'Bước 2: Gán đấu nối ga',
            'video_url' => "/images/$folder/B2.mp4",
        ],
        [
            'title' => 'Bước 3: Xuất bản vẽ hố ga',
            'video_url' => "/images/$folder/B3.mp4",
        ],
        [
            'title' => 'Bước 4: Xuất bảng tổng hợp khối lượng',
            'video_url' => "/images/$folder/B4.mp4",
        ],
        [
            'title' => 'Bước 5: Xuất bảng thống kê cốt thép qua excel (nếu cần)',
            'video_url' => "/images/$folder/B5.mp4",
        ],
    ];
}

$scenarios = [
    'tham-long-duong' => [
        'label' => 'Hố ga thăm lòng đường',
        'steps' => hoGaSteps('GATHAMLONGDUONG'),
    ],
    'tham-via-he' => [
        'label' => 'Hố ga thăm vỉa hè',
        'steps' => hoGaSteps('GATHUTHANVIAHE'),
    ],
    'ban-lap-ghep' => [
        'label' => 'Hố ga bán lắp ghép',
        'steps' => hoGaSteps('GABANLAPGHEP'),
    ],
    'cong-hop-kho-lon' => [
        'label' => 'Hố ga cống hộp khổ lớn',
        'steps' => hoGaSteps('GAHOPLON'),
    ],
];

$defaultScenario = array_key_first($scenarios);

require __DIR__ . '/../includes/header.php';
?>

<section>
    <h1 style="margin: 8px 0 10px; font-size: 1.9rem;"><?= htmlspecialchars($pageTitle) ?></h1>
    <p style="color: var(--text-muted); max-width: 60ch; margin-bottom: 24px;">
        Chọn loại hố ga phù hợp với công trình của bạn, sau đó làm theo các bước. Bấm vào từng bước để xem chi tiết, không cần chuyển trang.
    </p>

    <div class="scenario-switch" role="tablist" aria-label="Chọn loại hố ga">
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
