<?php

use BasicApp\Helpers\Url;
//use BasicApp\Messages\Forms\MessageConfigForm;
use BasicApp\System\SystemEvents;
use BasicApp\Admin\AdminEvents;

SystemEvents::onPreSystem(function() {

    helper('message');

});

if (class_exists(AdminEvents::class))
{
    AdminEvents::onMainMenu(function($menu) 
    {
        if (BasicApp\Messages\Controllers\Admin\Message::checkAccess())
        {
            $menu->items['system']['items']['messages'] = [
                'url'   => Url::createUrl('admin/message'),
                'label' => t('admin.menu', 'Messages'),
                'icon'  => 'fa fa-envelope'
            ];
        }    
    });
}

/*

CodeIgniter\Events\Events::on('admin_options_menu', function($menu) 
{
    if (BasicApp\Configs\Controllers\Admin\Config::checkAccess())
    {
        $menu->items[MessageConfigForm::class] = [
            'label' => t('admin.menu', 'Messages'),
            'icon' => 'fa fa-envelope',
            'url' => Url::createUrl('admin/config', ['class' => MessageConfigForm::class])
        ];
    }
});

*/