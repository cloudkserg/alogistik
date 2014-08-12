<?php

class m140812_052335_materials extends EDbMigration
{
	public function up()
	{
        $this->createTable(
            'materials',
            array(
                'id' => 'pk',
                'title'        => 'string',
                'density' => 'float',

                'created' => 'int',
                'modified' => 'int',
                'sort' => 'int not null',
                'published' => 'int not null'
            ),
            'DEFAULT CHARSET utf8'
        );
	}

	public function down()
	{
        $this->dropTable('materials');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}
