<?php

return array(

    'base_url'   => 'admin/logviewer',
    'filters'    => array(
        'global' => array(),
        'view'   => array(),
        'delete' => array()
    ),
    'log_dirs'   => array('app' => storage_path().'/logs'),
    'log_order'  => 'asc', // Change to 'desc' for the latest entries first
    'per_page'   => 30,
    'view'       => 'admin.logs.show',
    'p_view'     => 'pagination::slider'

);
