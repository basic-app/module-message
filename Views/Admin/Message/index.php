<?php

use BasicApp\Message\Models\MessageModel;
use BasicApp\Helpers\Url;

require __DIR__ . '/_common.php';

$this->data['actionMenu'][] = [
	'url' => Url::returnUrl('admin/message/create'), 
	'label' => t('admin.menu', 'Create'), 
	'icon' => 'fa fa-plus',
	'linkAttributes' => [
		'class' => 'btn btn-success'
	]	
];

unset($this->data['breadcrumbs'][count($this->data['breadcrumbs']) - 1]['url']);

$adminTheme = service('adminTheme');

echo $adminTheme->table([
    'labels' => [
        MessageModel::fieldLabel('message_id'),
        MessageModel::fieldLabel('message_uid'),
        MessageModel::fieldLabel('message_subject'),
        MessageModel::fieldLabel('message_enabled'),
        '',
        ''

    ],
    'elements' => $elements,
    'columns' => function($model) {
        return [
            $this->createColumn(['field' => 'message_id'])->number()->displaySmall(),
            $this->createColumn(['field' => 'message_uid']),
            $this->createColumn(['field' => 'message_subject'])->displaySmall(),
            $this->createBooleanColumn(['field' => 'message_enabled']),
            $this->createUpdateLinkColumn(['action' => 'admin/message/update']),
            $this->createDeleteLinkColumn(['action' => 'admin/message/delete'])
        ];
    }
]);

if ($pager)
{
    echo $pager->links('default', 'bootstrap4');
}