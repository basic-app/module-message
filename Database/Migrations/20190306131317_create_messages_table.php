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
        $where = [
            'name' => 'create_messages_table',
            'namespace' => 'BasicApp\System'
        ];

        $builder = $this->db->table('migrations');

        $builder->where($where);

        //$query = $builder->get();

        //$count = $query->count();

        $count = $builder->countAllResults();

        if ($count)
        {
            $builder = $this->db->table('migrations');

            $builder->where($where);

            $builder->delete();

            return;
        }

		$this->addField([
			'message_id' => $this->primaryKeyColumn(),
			'message_uid' => $this->stringColumn(['unique' => true]),
			'message_is_html' => $this->booleanColumn(),
			'message_enabled' => $this->booleanColumn(),			
			'message_subject' => $this->stringColumn(),
			'message_body' => $this->textColumn()
		]);

		$this->addKey('message_id', true);

		$this->createTable($this->tableName, false, ['ENGINE' => 'InnoDB']);
	}

	public function down()
	{
		$this->dropTable($this->tableName);
	}

}