<?php

return [
    'fileUrl' => env('FILE_URL', 'http://eems-rest.local/storage/'),
    'storage' => [
        'public' => env('PUBLIC', 'public'),
        'announcements' => env('ANNOUNCEMENTS', 'announcements')
    ],
    'role' => [
        'administrator' => env('ADMINISTRATOR_ROLE', 1),
        'employee' => env('EMPLOYEE_ROLE', 2),
    ]
];