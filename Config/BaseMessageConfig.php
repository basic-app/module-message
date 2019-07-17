<?php

namespace BasicApp\Messages\Config;

use BasicApp\Messages\Forms\MessageConfigForm;
use PHPMailer\PHPMailer\PHPMailer;

abstract class BaseMessageConfig extends \BasicApp\Core\DatabaseConfig
{

    protected $modelClass = MessageConfigForm::class;

	public $from_email;

	public $from_name;

    public $smtp_enabled = 0;

    public $smtp_host;

    public $smtp_username;

    public $smtp_password;

    public $smtp_port;

    public $smtp_secure;

    public $admin_name;

    public $admin_email;

    public $reply_to_type = MessageConfigForm::REPLY_TO_NONE;

    public $charset = PHPMailer::CHARSET_UTF8;

    public $encoding =PHPMailer::ENCODING_BASE64;

}