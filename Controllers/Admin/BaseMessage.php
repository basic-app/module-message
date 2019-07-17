<?php
/**
 * @package Basic App System
 * @license MIT License
 * @link    http://basic-app.com
 */
namespace BasicApp\Messages\Controllers\Admin;

use BasicApp\Messages\Models\Admin\MessageModel;
use BasicApp\Admins\Models\AdminModel;

abstract class BaseMessage extends \BasicApp\Admin\AdminCrudController
{

    protected static $roles = [AdminModel::ADMIN_ROLE];

	protected $modelClass = MessageModel::class;

	protected $viewPath = 'BasicApp\Messages\Admin\Message';

	protected $returnUrl = 'admin/message';	

}