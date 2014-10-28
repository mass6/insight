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
            'displayName' => 'Emrill',
            'code' => 'emrill',
            'store' => 5
        ],
        'chicago' => [
            'name' => 'Chicago',
            'displayName' => 'Chicago',
            'code' => 'chicago',
            'store' => 4
        ],
        'allaith' => [
            'name' => 'Allaith',
            'displayName' => 'Al Laith',
            'code' => 'allaith',
            'store' => 53
        ]
    ]
];