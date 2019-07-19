<?php
/**
 * @copyright Copyright (c) 2018-2019 Basic App Dev Team
 * @link http://basic-app.com
 * @license MIT License
 */
namespace BasicApp\Messages\Controllers\Admin;

use BasicApp\Messages\Models\Admin\MessageModel;
use BasicApp\Admins\Models\AdminModel;

abstract class BaseMessage extends \BasicApp\Admin\AdminCrudController
{

	protected $modelClass = MessageModel::class;

	protected $viewPath = 'BasicApp\Messages\Admin\Message';

	protected $returnUrl = 'admin/message';	

}