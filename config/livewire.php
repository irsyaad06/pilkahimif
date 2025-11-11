<?php

return [
    'temporary_file_upload' => [
        'disk' => 'public',
        'directory' => 'livewire-tmp',
        'rules' => ['file', 'max:51200'], // Harus array, bukan string
        'middleware' => null,
        'preview_mimes' => [
            'png',
            'gif',
            'bmp',
            'svg',
            'jpg',
            'jpeg',
            'webp',
        ],
        'max_upload_time' => 5, // Tambahkan ini
    ],
];
