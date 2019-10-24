<?php

use BasicApp\Helpers\Url;

$theme = service('adminTheme');

$form = $theme->createForm($model, $errors);

$url = Url::currentUrl();

echo $form->open($url);

echo $form->inputGroup($data, 'message_subject');

echo $form->inputGroup($data, 'message_uid');

echo $form->textareaGroup($data, 'message_body');

echo $form->checkboxGroup($data, 'message_is_html');

echo $form->checkboxGroup($data, 'message_send_copy_to_admin');

echo $form->checkboxGroup($data, 'message_enabled');

echo $form->renderErrors();

$label = $model->getPrimaryKey() ? t('admin', 'Update') : t('admin', 'Insert');

echo $form->submitButton($label);

echo $form->close();