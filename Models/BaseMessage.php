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

    public function __construct()
    {
        parent::__construct();

        $this->message_is_html = 1;

        $this->message_send_copy_to_admin = 0;

        $this->message_enabled = 1;
    }

}