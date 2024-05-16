<?php

return [
    'custom_font_dir'  => base_path('resources/fonts/'), // don't forget the trailing slash!
    'custom_font_data' => [
        'dubai' => [ // must be lowercase and snake_case
            'R'  => 'Dubai-Regular.ttf',    // regular font
            'L'  => 'Dubai-Light.ttf',    // regular font
            'M'  => 'Dubai-Medium.ttf',    // regular font
            'B'  => 'Dubai-Bold.ttf',    // regular font
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ],
        'rubik' => [
            'R' => 'Rubik-Regular.ttf',
            'B' => 'Rubik-Bold.ttf',
            'L' => 'Rubik-Light.ttf',
            'M' => 'Rubik-Medium.ttf',
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ]

    ]
];
