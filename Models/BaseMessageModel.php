<?php
/**
 * @copyright Copyright (c) 2018-2019 Basic App Dev Team
 * @link http://basic-app.com
 * @license MIT License
 */
namespace BasicApp\Message\Models;

abstract class BaseMessageModel extends \BasicApp\Core\Model
{

	protected $table = 'messages';

	protected $primaryKey = 'message_id';

	protected $returnType = Message::class;

    protected $fieldLabels = [
        'message_id' => 'ID',
        'message_uid' => 'UID',
        'message_subject' => 'Subject',
        'message_body' => 'Body',
        'message_is_html' => 'HTML format'
    ];

    protected $langCategory = 'message';

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