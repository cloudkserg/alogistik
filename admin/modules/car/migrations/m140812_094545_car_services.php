<?php

class m140812_094545_car_services extends EDbMigration
{
	public function up()
	{
        $this->createTable(
            'car_services',
            array(
                'id' => 'pk',
                'title' => 'string',
                'car_id' => 'int',
                'begin_price' => 'float',
                'text' => 'text',
                'length' => 'string',
                'width' => 'string',
                'height' => 'string',
 
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
        $this->dropTable('car_services');
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
