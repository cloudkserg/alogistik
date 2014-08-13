<?php

class m140812_094537_cars extends EDbMigration
{
	public function up()
	{
        $this->createTable(
            'cars',
            array(
                'id' => 'pk',
                'title' => 'string',

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
        $this->dropTable('cars');
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
