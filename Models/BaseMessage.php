<?php
/**
 * @package Basic App System
 * @license MIT License
 * @link    http://basic-app.com
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