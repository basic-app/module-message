<?php

use BasicApp\Helpers\Url;

$this->data['mainMenu']['system']['items']['messages']['active'] = true;

$this->data['title'] = t('admin', 'Messages');

$this->data['breadcrumbs'][] = ['label' => $this->data['title'], 'url' => Url::createUrl('/admin/message')];
