<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| View Storage Paths
	|--------------------------------------------------------------------------
	|
	| Most templating systems load templates from disk. Here you may specify
	| an array of paths that should be checked for your views. Of course
	| the usual Laravel view path has already been registered for you.
	|
	*/

	'paths' => array(__DIR__.'/../views'),

	/*
	|--------------------------------------------------------------------------
	| Pagination View
	|--------------------------------------------------------------------------
	|
	| This view will be used to render the pagination link output, and can
	| be easily customized here to show any view you like. A clean view
	| compatible with Twitter's Bootstrap is given to you by default.
	|
	*/

	'pagination' => 'pagination::slider-3',


    /*
	|--------------------------------------------------------------------------
	| Default Layout
	|--------------------------------------------------------------------------
	|
	| This will be used to assign the default template layout.
	|
	*/

    'layout' => [
        'default' => 'neon',
        'admin'   => 'neon',
        'company'  => [
            '36s'       => [
                'layout' => '36s',
                'path'  => 'layouts.36s'
                ],
            'emrill'    => [
                'layout' => 'emrill',
                'path' => 'layouts.emrill'
                ],
            'chicago'    => [
                'layout' => 'chicago',
                'path' => 'layouts.chicago'
            ],
            'allaith'    => [
                'layout' => 'allaith',
                'path' => 'layouts.allaith'
            ],
        ]
    ],

    /*
	|--------------------------------------------------------------------------
	| Dashboard
	|--------------------------------------------------------------------------
	|
	| This assigns the dashboard to each customer/group.
	|
	*/

    'dashboard' => [
        '36s' => 'Dashboard01',
        'emrill' => 'Dashboard10',
        'chicago' => 'Dashboard10',
    ]

);
