<?php

use BasicApp\Helpers\Url;
use BasicApp\Admin\AdminEvents;
use BasicApp\Message\Controllers\Admin\Message as MessageController;
use BasicApp\AdminMenu\AdminMenuEvents;

if (class_exists(AdminMenuEvents::class))
{
    AdminMenuEvents::onMainMenu(function($menu) 
    {
        $menu->items['system']['items']['message'] = [
            'url'   => Url::createUrl('admin/message'),
            'label' => t('admin.menu', 'Messages')
        ];
    });
}