<?php
/**
 * @copyright Copyright (c) 2018-2019 Basic App Dev Team
 * @link http://basic-app.com
 * @license MIT License
 */
namespace BasicApp\Message\Database\Migrations;

class Migration_create_messages_table extends \BasicApp\Core\Migration
{

	public $table = 'messages';

	public function up()
	{
		$this->forge->addField([
			'message_id' => $this->primaryKey()->toArray(),
			'message_uid' => $this->string()->unique()->toArray(),
			'message_subject' => $this->string()->toArray(),
            'message_body' => $this->text()->toArray(),
            'message_is_html' => $this->boolean()->toArray()
        ]);

		$this->forge->addKey('message_id', true);

		$this->forge->createTable($this->table);
	}

	public function down()
	{
		$this->forge->dropTable($this->table);
	}

}