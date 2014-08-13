<?php

class m140812_094615_car_service_params extends EDbMigration
{
	public function up()
	{
        $this->createTable(
            'car_service_params',
            array(
                'id' => 'pk',
                'title' => 'string',
                'value' => 'string',
                'car_service_id' => 'int',
 
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
        $this->dropTable('car_service_params');
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
