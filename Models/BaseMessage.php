<?php
/**
 * @copyright Copyright (c) 2018-2019 Basic App Dev Team
 * @link http://basic-app.com
 * @license MIT License
 */
namespace BasicApp\Messages\Models;

abstract class BaseMessage extends \BasicApp\Core\Entity
{

	protected $modelClass = MessageModel::class;

	public $message_id;

	public $message_uid;

	public $message_subject;

	public $message_body;

	public $message_is_html;

	public $message_send_copy_to_admin;

	public $message_enabled;

}