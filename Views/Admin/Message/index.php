<?php

use BasicApp\Messages\Models\MessageModel;
use BasicApp\Helpers\Url;

require __DIR__ . '/_common.php';

$this->data['actionMenu'][] = [
	'url' => Url::returnUrl('admin/message/create'), 
	'label' => t('admin.menu', 'Add'), 
	'icon' => 'fa fa-plus',
	'linkOptions' => [
		'class' => 'btn btn-success'
	]	
];

unset($this->data['breadcrumbs'][count($this->data['breadcrumbs']) - 1]['url']);

$adminTheme = service('adminTheme');

echo $adminTheme->table([
    'defaultRow' => MessageModel::createEntity(),
    'rows' => $elements,
    'columns' => function($model) {
        return [
            $this->createColumn(['attribute' => 'message_id'])->number()->displaySmall(),
            $this->createColumn(['attribute' => 'message_uid']),
            $this->createColumn(['attribute' => 'message_subject'])->displaySmall(),
            $this->createBooleanColumn(['attribute' => 'message_enabled']),
            $this->createUpdateLinkColumn(['action' => 'admin/message/update']),
            $this->createDeleteLinkColumn(['action' => 'admin/message/delete'])
        ];
    }
]);

if ($pager)
{
    echo $pager->links('default', 'bootstrap4');
}