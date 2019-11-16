<?php

require __DIR__ . '/_common.php';

$this->data['breadcrumbs'][] = ['label' => t('admin', 'Add')];

$this->data['enableCard'] = true;

$this->data['cardTitle'] = $this->data['title'];

echo app_view('BasicApp\Message\Admin\Message\_form', [
        'model' => $model,
        'errors' => $errors
    ]
);