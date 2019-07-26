<?php

use BasicApp\Helpers\Url;
use BasicApp\Messages\Forms\MessageConfigForm;

BasicApp\Core\CoreEvents::onPreSystem(function() {

    helper('message');

});

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

CodeIgniter\Events\Events::on('admin_main_menu', function($menu) 
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