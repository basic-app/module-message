<?php
/**
 * @copyright Copyright (c) 2018-2019 Basic App Dev Team
 * @link http://basic-app.com
 * @license MIT License
 */
namespace BasicApp\Message\Models;

use BasicApp\Mailer\Config\Mailer;

abstract class BaseMessage extends \BasicApp\Core\Entity
{

	protected $modelClass = MessageModel::class;

    public function __construct()
    {
        parent::__construct();

        $this->message_is_html = 1;
    }

    public function applyToEmail($email, array $params = [])
    {
        $subject = $this->message_subject;

        $message = $this->message_body;

        $email->setSubject(strtr($subject, $params));

        $email->setMessage(strtr($message, $params));
    }

    public function sendToUser($user, array $params = [], & $error = null, array $options = [], array $mailerOptions = [])
    {
        $mailer = config(Mailer::class);

        $email = $mailer->createEmail($mailerOptions);

        $email->setTo($user->user_email, $user->user_name);

        $params['{base_url}'] = base_url();

        $params['{user_email}'] = $user->user_email;

        $params['{user_name}'] = $user->user_name;

        $this->applyToEmail($email, $params);

        return $mailer->sendEmail($email, $options, $error);
    }

    public function sendToAdmin(array $params = [], & $error = null, array $options = [], array $mailerOptions = [])
    {
        $mailer = config(Mailer::class);

        $email = $mailer->createEmail($mailerOptions);

        $email->setTo($mailer->from_email, $mailer->from_name);

        $params['{base_url}'] = base_url();

        $this->applyToEmail($email, $params);

        return $mailer->sendEmail($email, $options, $error);
    }

}