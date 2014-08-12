<?php

class m140812_052343_material_service extends EDbMigration
{
	public function up()
	{
        $this->createTable(
            'material_services',
            array(
                'id' => 'pk',
                'title'        => 'string',
                'material_id' => 'int',
                'begin_price' => 'float',
                'text' => 'text',
 
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
        $this->dropTable('material_services');
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
