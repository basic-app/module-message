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
    'emptyRow' => MessageModel::createEntity(),
    'rows' => $elements,
    'columns' => function($model) {

        $updateUrl = Url::returnUrl('admin/message/update', ['id' => $model->getPrimaryKey()]);

        $deleteUrl = Url::returnUrl('admin/message/delete', ['id' => $model->getPrimaryKey()]);

        return [
            $this->createColumn([
                'attribute' => 'message_id',
                'header' => $model->label('message_id')
                
            ])->number()->displaySmall(),
            $this->createColumn([
                'attribute' => 'message_uid',
                'header' => $model->label('message_uid')
            ]),
            $this->createColumn([
                'attribute' => 'message_subject',
                'header' => $model->label('message_subject')
                
            ])->displaySmall(),
            $this->booleanColumn([
                'attribute' => 'message_enabled',
                'header' => $model->label('message_enabled')
            ]),
            $this->updateButtonColumn(['url' => $updateUrl]),
            $this->deleteButtonColumn(['url' => $deleteUrl])
        ];
    }
]);

if ($pager)
{
    echo $pager->links('default', 'bootstrap4');
}