<?php

$routes->add('admin/message', 'BasicApp\Messages\Controllers\Admin\Message::index');
$routes->add('admin/message/(:segment)', 'BasicApp\Messages\Controllers\Admin\Message::$1');