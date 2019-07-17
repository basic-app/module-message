<?php
/**
 * @package Basic App System
 * @license MIT License
 * @link    http://basic-app.com
 */
namespace BasicApp\Messages\Models;

abstract class BaseMessageModel extends \BasicApp\Core\Model
{

	protected $table = 'messages';

	protected $primaryKey = 'message_id';

	protected $returnType = Message::class;

    protected $labels = [
        'message_uid' => 'Message UID',
        'message_subject' => 'Message Subject',
        'message_body' => 'Message Body',
        'message_is_html' => 'Message is HTML',
        'message_send_copy_to_admin' => 'Send Copy to Admin',
        'message_enabled' => 'Enabled'
    ];

    protected $translations = 'messages';

	public static function getMessage(string $uid, bool $create = false, array $params = [])
	{
		return static::getEntity(['message_uid' => $uid], $create, $params);
	}

    public static function getListItems($return = [])
    { 
    	$query = static::factory()->orderBy('message_subject ASC'); 

        foreach($query->findAll() as $model)
        {
            $return[$model->message_id] = $model->message_name;
        }

        return $return;
    }

}