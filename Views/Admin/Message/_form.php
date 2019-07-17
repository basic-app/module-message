<?php

use BasicApp\Helpers\Url;

$theme = service('adminTheme');

$form = $theme->createForm(['errors' => $errors, 'model' => $model]);

$url = Url::currentUrl();

echo $form->formOpen($url);

echo $form->input('message_uid');

echo $form->input('message_subject');

echo $form->textarea('message_body');

echo $form->checkbox('message_is_html');

echo $form->checkbox('message_send_copy_to_admin');

echo $form->checkbox('message_enabled');

echo $form->renderErrors();

$label = $model->getPrimaryKey() ? t('admin', 'Update') : t('admin', 'Insert');

echo $form->submit($label);

echo $form->formClose();