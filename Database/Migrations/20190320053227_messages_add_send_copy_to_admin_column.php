<?php

namespace BasicApp\System\Database\Migrations;

class Migration_messages_add_send_copy_to_admin_column extends \BasicApp\Core\Migration
{

    public $tableName = 'messages';

    public function up()
    {
        $this->forge->addColumn($this->tableName, [
            'message_send_copy_to_admin' => $this->boolColumn()
        ]);
    }

    public function down()
    {
       $this->forge->dropColumn($this->tableName, 'message_send_copy_to_admin');
    }

}