<?php
/**
 * @copyright Copyright (c) 2018-2019 Basic App Dev Team
 * @link http://basic-app.com
 * @license MIT License
 */
use BasicApp\Messages\Models\MessageModel;
use BasicApp\Messages\Models\MessageConfig;
use BasicApp\Messages\Models\MessageConfigModel;
use PHPMailer\PHPMailer\PHPMailer;

if (!function_exists('parse_message_recipient'))
{
	/**
	 * Parse string "User 1 <user@example.com>, user2@example.com" to array ["user@example.com>" => "User 1", user2@example.com]
	 */
	function parse_recipients_string(string $string)
	{
		$return = [];

		foreach(explode(',', $string) as $segment)
		{
			$segment = trim($segment);

		   	if (preg_match('|(.*)' . preg_quote('<', '|'). '(.+)' . preg_quote('>', '|') .'|', $segment, $matches))
		   	{
		   		$to_name = $matches[1];

		   		$to_email = $matches[2];

		   		$to_name = trim($to_name);

		   		$return[$email] = $name;
		   	}
		   	else
		   	{
		   		$return[] = $string;
		   	}
		}

	   	return $return;
	}
}

if (!function_exists('mailer_add_attachements'))
{
	function mailer_add_attachements($mail, array $attachments = [])
	{
		foreach($attachments as $key => $value)
		{
			if (is_numeric($key))
			{
				$mail->addAttachment($value);
			}
			else
			{
				$mail->addAttachment($key, $value);
			}
		}
	}
}

if (!function_exists('mailer_set_recipients'))
{
	function mailer_set_recipients($mail, array $to = [])
	{
        $i = 0;

        foreach($to as $key => $value)
        {
            if (is_numeric($key))
            {
                $to_name = null;

                $to_email = $value;
            }
            else
            {
                $to_name = $value;

                $to_email = $key;
            }

            if ($i == 0)
            {
                if ($to_name)
                {
                    $mail->addAddress($to_email, $to_name);
                }
                else
                {
                    $mail->addAddress($to_email);
                }
            }
            else
            {
                if ($to_name)
                {
                    $mail->addCC($to_email, $to_name);
                }
                else
                {
                    $mail->addCC($to_email);
                }
            }

            $i++;
        }
	}
}

if (!function_exists('create_mailer'))
{
    function create_mailer($send_copy_to_admin = false, array $attachments = [])
    {
        $config = config(MessageConfig::class);

        $mail = new PHPMailer(false);

        if ($config->encoding)
        {
            $mail->Encoding = $config->encoding;
        }

        $mail->CharSet = PHPMailer::CHARSET_UTF8;

        if ($config->smtp_enabled)
        {
            $mail->SMTPDebug = 2; // Enable verbose debug output
            
            $mail->isSMTP(); // Set mailer to use SMTP
            
            $mail->Host = $config->smtp_host;//'smtp1.example.com;smtp2.example.com'; // Specify main and backup SMTP servers
            
            if ($config->smtp_username)
            {
                $mail->SMTPAuth = true; // Enable SMTP authentication
            
                $mail->Username = $config->smtp_username; // SMTP username
            
                $mail->Password = $config->smtp_password; // SMTP password
            }
    
            if ($config->smtp_secure)
            {
                $mail->SMTPSecure = $config->smtp_secure;//'tls'; // Enable TLS encryption, `ssl` also accepted
            }

            if ($config->smtp_port)
            {
                $mail->Port = $config->smtp_port; //587; // TCP port to connect to
            }
        }

        if (!$config->from_email)
        {
            throw new Exception('From address is not defined.');
        }
        
        if ($config->from_name)
        {
            $mail->setFrom($config->from_email, $config->from_name);
        }
        else
        {
            $mail->setFrom($config->from_email);
        }

        $reply_to_email = null;

        $reply_to_name = null;

        if ($config->reply_to_type == MessageConfigModel::REPLY_TO_ADMIN)
        {
            $reply_to_email = $config->admin_email;

            $reply_to_name = $config->admin_name;
        }
        elseif ($config->reply_to_type == MessageConfigModel::REPLY_TO_FROM)
        {
            $reply_to_email = $config->from_email;

            $reply_to_name = $config->from_name;
        }

        if ($reply_to_email)
        {
            if ($reply_to_name)
            {
                $mail->addReplyTo($reply_to_email, $reply_to_name);
            }
            else
            {
                $mail->addReplyTo($reply_to_email);
            }
        }

        if ($send_copy_to_admin && $config->admin_email)
        {
            if ($config->admin_name)
            {
                $mail->addBCC($config->admin_email, $config->admin_name);
            }
            else
            {
                $mail->addBCC($config->admin_email);
            }
        }

        if ($attachments)
        {
        	mailer_add_attachements($mail, $attachments);
        }

        return $mail;
    }
}

if (!function_exists('send_message'))
{
	function send_message(string $uid, array $to = [], bool $create = true, array $message_params = [], array $params = [], array $mailer_options = [], Closure $callback = null)
	{
        $message = MessageModel::getMessage($uid, $create, $message_params);

        if (!$message || !$message->message_enabled)
        {
            return;
        }

        $attachments = [];

        if (array_key_exists('attachments', $mailer_options))
        {
        	$attachments = $mailer_options['attachments'];
        }

        $mail = create_mailer($message->message_send_copy_to_admin, $attachments);

        $mail->isHTML($message->message_is_html); // Set email format to HTML or not
        
        $mail->Subject = strtr($message->message_subject, $params);
        
        $mail->Body = strtr($message->message_body, $params);

         //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        // Send message to the admin if a recipient is not defined.

        if (count($to) == 0)
        {
        	if ($config->admin_email)
        	{
	            if ($config->admin_name)
	            {
	                $to[$config->admin_email] = $config->admin_name;
	            }
	            else
	            {
	                $to[] = $config->admin_email;
	            }
        	}
        }

        mailer_set_recipients($mail, $to);

        if ($callback)
        {
            $callback($mail);
        }

	    $result = $mail->send();

	   	if ($result)
	   	{
	   		return true;
	   	}

	   	throw new Exception($mail->ErrorInfo);
	}
}