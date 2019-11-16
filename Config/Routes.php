<?php

$routes->add('admin/message', 'BasicApp\Message\Controllers\Admin\Message::index');
$routes->add('admin/message/(:segment)', 'BasicApp\Message\Controllers\Admin\Message::$1');