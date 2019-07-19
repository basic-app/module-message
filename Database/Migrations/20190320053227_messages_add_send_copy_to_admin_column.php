<?php
/**
 * @copyright Copyright (c) 2018-2019 Basic App Dev Team
 * @link http://basic-app.com
 * @license MIT License
 */
namespace BasicApp\Messages\Database\Migrations;

class Migration_messages_add_send_copy_to_admin_column extends \BasicApp\Core\Migration
{

    public $tableName = 'messages';

    public function up()
    {
        $this->addColumn($this->tableName, [
            'message_send_copy_to_admin' => $this->booleanColumn()
        ]);
    }

    public function down()
    {
       $this->dropColumn($this->tableName, 'message_send_copy_to_admin');
    }

}