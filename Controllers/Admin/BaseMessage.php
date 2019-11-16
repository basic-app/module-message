<?php
/**
 * @copyright Copyright (c) 2018-2019 Basic App Dev Team
 * @link http://basic-app.com
 * @license MIT License
 */
namespace BasicApp\Message\Controllers\Admin;

use BasicApp\Message\Models\Admin\MessageModel;

abstract class BaseMessage extends \BasicApp\Admin\AdminCrudController
{

	protected $modelClass = MessageModel::class;

	protected $viewPath = 'BasicApp\Message\Admin\Message';

	protected $returnUrl = 'admin/message';	

}