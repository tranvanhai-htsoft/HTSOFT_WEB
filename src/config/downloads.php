<?php

/**
 * Danh mục file cài đặt theo mô-đun — nguồn duy nhất cho public/tai-xuong.php
 * (hiện danh sách) và public/tai-file.php (kiểm tra hợp lệ trước khi cho tải).
 * File thật đặt tại storage/downloads/ (ngoài webroot) — xem README ở đó.
 */
return [
    'cong-tron-cong-hop-duc-san' => [
        'name' => 'Mô-đun 1: Cống Tròn & Cống Hộp Đúc Sẵn',
        'variants' => [
            '2021-2024' => ['label' => 'AutoCAD 2021–2024', 'file' => 'cong-tron-cong-hop-duc-san-2021-2024.zip'],
            '2025-2026' => ['label' => 'AutoCAD 2025–2026', 'file' => 'cong-tron-cong-hop-duc-san-2025-2026.zip'],
        ],
    ],
    'cong-hop-do-tai-cho' => [
        'name' => 'Mô-đun 2: Cống Hộp Đổ Tại Chỗ',
        'variants' => [
            '2021-2024' => ['label' => 'AutoCAD 2021–2024', 'file' => 'cong-hop-do-tai-cho-2021-2024.zip'],
            '2025-2026' => ['label' => 'AutoCAD 2025–2026', 'file' => 'cong-hop-do-tai-cho-2025-2026.zip'],
        ],
    ],
    'cau-ban-cong-ban-tran-lien-hop' => [
        'name' => 'Mô-đun 3: Cầu Bản – Cống Bản – Tràn Liên Hợp',
        'variants' => [
            '2021-2024' => ['label' => 'AutoCAD 2021–2024', 'file' => 'cau-ban-cong-ban-tran-lien-hop-2021-2024.zip'],
            '2025-2026' => ['label' => 'AutoCAD 2025–2026', 'file' => 'cau-ban-cong-ban-tran-lien-hop-2025-2026.zip'],
        ],
    ],
    'thiet-ke-ho-ga' => [
        'name' => 'Mô-đun 4: Thiết Kế Hố Ga',
        'variants' => [
            '2021-2024' => ['label' => 'AutoCAD 2021–2024', 'file' => 'thiet-ke-ho-ga-2021-2024.zip'],
            '2025-2026' => ['label' => 'AutoCAD 2025–2026', 'file' => 'thiet-ke-ho-ga-2025-2026.zip'],
        ],
    ],
    'thiet-ke-cau-gian-don' => [
        'name' => 'Mô-đun 5: Thiết Kế Cầu Giản Đơn BTCT DƯL',
        'variants' => [
            '2021-2024' => ['label' => 'AutoCAD 2021–2024', 'file' => 'thiet-ke-cau-gian-don-2021-2024.zip'],
            '2025-2026' => ['label' => 'AutoCAD 2025–2026', 'file' => 'thiet-ke-cau-gian-don-2025-2026.zip'],
        ],
    ],
    'kiem-toan-cau-gian-don' => [
        'name' => 'Mô-đun 6: Kiểm Toán Cầu Giản Đơn',
        'variants' => [
            'standard' => ['label' => 'Bản cài đặt', 'file' => 'kiem-toan-cau-gian-don.zip'],
        ],
    ],
    'kiem-toan-cau-ban' => [
        'name' => 'Mô-đun 7: Kiểm Toán Cầu Bản',
        'variants' => [
            'standard' => ['label' => 'Bản cài đặt', 'file' => 'kiem-toan-cau-ban.zip'],
        ],
    ],
    'kiem-toan-cong-hop' => [
        'name' => 'Mô-đun 8: Kiểm Toán Cống Hộp',
        'variants' => [
            'standard' => ['label' => 'Bản cài đặt', 'file' => 'kiem-toan-cong-hop.zip'],
        ],
    ],
];
