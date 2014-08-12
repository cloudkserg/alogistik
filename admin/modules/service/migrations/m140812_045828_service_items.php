<?php

class m140812_045828_service_items extends EDbMigration
{
	public function up()
	{
        $this->createTable(
            'service_items',
            array(
                'id' => 'pk',
                'title'        => 'string',
                'text'         => 'longtext',
                'service_id' => 'int',

                'created' => 'int',
                'modified' => 'int',
                'sort' => 'int not null',
                'published' => 'int not null'
            ),
            'DEFAULT CHARSET utf8'
        );

        $this->createTable(
            'service_item_cars',
            array(
                'id' => 'pk',
                'service_item_id' => 'int',
                'car_id' => 'int'
            ),
            'DEFAULT CHARSET utf8'
        );
	}

	public function down()
    {
        $this->dropTable('service_items');
        $this->dropTable('service_item_cars');
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
