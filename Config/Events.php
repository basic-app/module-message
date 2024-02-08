<?php

use BasicApp\Helpers\Url;
use BasicApp\Admin\AdminEvents;
use BasicApp\Message\Controllers\Admin\Message as MessageController;

if (class_exists(AdminEvents::class))
{
    AdminEvents::onMainMenu(function($menu) 
    {
        $menu->items['system']['items']['message'] = [
            'url'   => Url::createUrl('admin/message'),
            'label' => t('admin.menu', 'Messages')
        ];
    });
}