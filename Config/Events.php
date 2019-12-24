<?php

use BasicApp\Helpers\Url;
use BasicApp\Admin\AdminEvents;

if (class_exists(AdminEvents::class))
{
    AdminEvents::onMainMenu(function($menu) 
    {
        if (BasicApp\Message\Controllers\Admin\Message::checkAccess())
        {
            $menu->items['system']['items']['message'] = [
                'url'   => Url::createUrl('admin/message'),
                'label' => t('admin.menu', 'Messages')
            ];
        }    
    });
}