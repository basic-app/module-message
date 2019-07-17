<?php
/**
 * @package Basic App System
 * @license MIT License
 * @link    http://basic-app.com
 */
namespace BasicApp\Messages\Forms;

use BasicApp\Messages\Config\MessageConfig;
use PHPMailer\PHPMailer\PHPMailer;
use BasicApp\Core\Form;

abstract class BaseMessageConfigForm extends \BasicApp\Core\DatabaseConfigForm
{

    const REPLY_TO_NONE = '';

    const REPLY_TO_ADMIN = 'admin';
    
    const REPLY_TO_FROM = 'from';

    protected $returnType = MessageConfig::class;

    protected $validationRules = [
        'from_name' => 'max_length[255]',
        'from_email' => 'max_length[255]|valid_email|required',
        'smtp_enabled' => 'is_natural',
        'smtp_host' => 'max_length[255]',
        'smtp_username' => 'max_length[255]',
        'smtp_password' => 'max_length[255]',
        'smtp_secure' => 'max_length[255]',
        'smtp_port' => 'is_natural',
        'encoding' => 'max_length[255]',
        'charset' => 'max_length[255]',
        'reply_to_type' => 'max_length[255]',
        'admin_email' => 'max_length[255]|valid_email',
        'admin_name' => 'max_length[255]'
    ];

    protected $labels = [
        'from_name' => 'From Name',
        'from_email' => 'From E-mail',
        'smtp_enabled' => 'Use SMTP',
        'smtp_host' => 'SMTP Host',
        'smtp_port' => 'SMTP Port',
        'smtp_username' => 'SMTP Username',
        'smtp_password' => 'SMTP Password',
        'smtp_secure' => 'SMTP Encryption',
        'encoding' => 'Encoding',
        'charset' => 'Charset',
        'reply_to_type' => 'Reply To',
        'admin_name' => 'Admin Name',
        'admin_email' => 'Admin E-mail'
    ];

    protected $translations = 'messages';

    public static function getFormName()
    {
        return t('admin.menu', 'E-mail');
    }

    public function renderFields(Form $form)
    {
        $return = '';

        $return .= $form->input('from_name');

        $return .= $form->input('from_email');

        $return .= $form->dropdown('reply_to_type', static::replyToTypeItems([static::REPLY_TO_NONE => '...']));

        $return .= $form->input('admin_name');

        $return .= $form->input('admin_email');

        $return .= $form->dropdown('charset', static::charsetItems(['' => '...']));

        $return .= $form->dropdown('encoding', static::encodingItems(['' => '...']));

        $return .= $form->checkbox('smtp_enabled');

        $return .= $form->input('smtp_host');

        $return .= $form->input('smtp_port');

        $return .= $form->input('smtp_username');

        $return .= $form->password('smtp_password');

        $return .= $form->dropdown('encoding', static::smtpSecureItems(['' => '...']));

        return $return;
    }

    public static function smtpSecureItems(array $return = [])
    {
        $return['tls'] = 'TLS';
        
        $return['ssl'] = 'SSL';

        return $return;
    }

    public static function encodingItems(array $return = [])
    {
        $return[PHPMailer::ENCODING_7BIT] = PHPMailer::ENCODING_7BIT;
        
        $return[PHPMailer::ENCODING_8BIT] = PHPMailer::ENCODING_8BIT;
        
        //$return['16bit'] = '16bit'; // not tested
        
        $return[PHPMailer::ENCODING_BASE64] = PHPMailer::ENCODING_BASE64;
        
        $return[PHPMailer::ENCODING_BINARY] = PHPMailer::ENCODING_BINARY;
        
        $return[PHPMailer::ENCODING_QUOTED_PRINTABLE] = PHPMailer::ENCODING_QUOTED_PRINTABLE;

        return $return;
    }

    public static function charsetItems(array $return = [])
    {
        $return[PHPMailer::CHARSET_UTF8] =  PHPMailer::CHARSET_UTF8;
        
        $return[PHPMailer::CHARSET_ISO88591] = PHPMailer::CHARSET_ISO88591;

        return $return;
    }

    public static function replyToTypeItems(array $return = [])
    {
    	$return[static::REPLY_TO_FROM] = t('message', 'Reply-To Sender');

    	$return[static::REPLY_TO_ADMIN] = t('message', 'Reply-To Admin');

    	return $return;
    }

}