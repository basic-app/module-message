<?php
/**
 * @copyright Copyright (c) 2018-2019 Basic App Dev Team
 * @link http://basic-app.com
 * @license MIT License
 */
namespace BasicApp\Messages\Models\Admin;

abstract class BaseMessageModel extends \BasicApp\Messages\Models\MessageModel
{

	protected $allowedFields = [
		'message_subject',
		'message_body',
		'message_uid',
		'message_is_html',
		'message_send_copy_to_admin',
		'message_enabled'
	];

	protected $validationRules = [
		'message_uid' => 'trim|required|alpha_dash|max_length[255]|is_unique[messages.message_uid,message_id,{message_id}]',
		'message_subject' => 'trim|required|max_length[255]',
		'message_body' => 'trim|required|max_length[65535]',
		'message_is_html' => 'trim|required|is_natural',
		'message_send_copy_to_admin' => 'trim|required|is_natural',
		'message_enabled' => 'trim|required|is_natural'
	];

	public static function createEntity(array $params = [])
	{
		$params['message_is_html'] = 1;

		$params['message_send_copy_to_admin'] = 0;

		$params['message_enabled'] = 1;

		return parent::createEntity($params);
	}

}