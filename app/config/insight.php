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
            'store' => 5
        ],
        'chicago' => [
            'name' => 'Chicago',
            'store' => 4
        ],
        'allaith' => [
            'name' => 'Allaith',
            'store' => 53
        ]
    ]
];