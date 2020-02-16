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

echo $adminTheme->grid([
    'headers' => [
        [
            'class' => $adminTheme::GRID_HEADER_PRIMARY_KEY,
            'content' => $model->getFieldLabel('message_id')
        ],
        [
            'class' => $adminTheme::GRID_HEADER_LABEL,
            'content' => $model->getFieldLabel('message_subject')
        ],
        [
            'class' => $adminTheme::GRID_HEADER_MEDIUM,
            'content' => $model->getFieldLabel('message_uid')
        ],
        [
            'class' => $adminTheme::GRID_HEADER_BOOLEAN,
            'content' => $model->getFieldLabel('message_is_html')
        ],
        ['class' => $adminTheme::GRID_HEADER_BUTTON_UPDATE],
        ['class' => $adminTheme::GRID_HEADER_BUTTON_DELETE]
    ],
    'items' => function() use ($elements, $adminTheme) {

        foreach($elements as $data)
        {
            yield [
                $data->message_id,
                $data->message_subject,
                $data->message_uid,
                $data->message_is_html,
                ['url' => Url::returnUrl('admin/message/update', ['id' => $data->message_id])],
                ['url' => Url::returnUrl('admin/message/delete', ['id' => $data->message_id])]
            ];
        }
    }
]);

if ($pager)
{
    echo $pager->links('default', 'adminTheme');
}