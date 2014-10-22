<?php

return [
    'listeners' =>  [
        'Insight\Listeners\ActivityLogger',
        'Insight\Listeners\EmailNotifier',
        'Insight\Listeners\PortalDataUpdatesNotifier',
    ],
    'customers' => [
        'emrill' => [
            'name' => 'Emrill',
            'code' => 'emrill',
            'store' => 5
        ],
        'chicago' => [
            'name' => 'Chicago',
            'code' => 'chicago',
            'store' => 4
        ],
        'allaith' => [
            'name' => 'Al Laith',
            'code' => 'allaith',
            'store' => 53
        ]
    ]
];