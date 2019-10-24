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
		'message_uid' => 'required|alpha_dash|max_length[255]|is_unique[messages.message_uid,message_id,{message_id}]',
		'message_subject' => 'required|max_length[255]',
		'message_body' => 'required|max_length[65535]',
		'message_is_html' => 'required|is_natural',
		'message_send_copy_to_admin' => 'required|is_natural',
		'message_enabled' => 'required|is_natural'
	];

}