<?php

class m140812_045815_services extends EDbMigration
{
	public function up()
	{
        $this->createTable(
            'services',
            array(
                'id' => 'pk',
                'title'        => 'string',
                'text'        => 'text',

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
        $this->dropTable('services');
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
