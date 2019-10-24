<?php
/**
 * @copyright Copyright (c) 2018-2019 Basic App Dev Team
 * @link http://basic-app.com
 * @license MIT License
 */
namespace BasicApp\Messages\Database\Migrations;

class Migration_create_messages_table extends \BasicApp\Core\Migration
{

	public $tableName = 'messages';

	public function up()
	{
		$this->forge->addField([
			'message_id' => $this->primaryKey()->toArray(),
			'message_uid' => $this->string()->unique()->toArray(),
			'message_is_html' => $this->boolean()->toArray(),
			'message_enabled' => $this->boolean()->toArray(),			
			'message_subject' => $this->string()->toArray(),
            'message_send_copy_to_admin' => $this->boolean()->toArray(),
            'message_body' => $this->text()->toArray()
        ]);

		$this->forge->addKey('message_id', true);

		$this->forge->createTable($this->tableName);
	}

	public function down()
	{
		$this->forge->dropTable($this->tableName);
	}

}