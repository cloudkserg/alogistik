<?php

class m140812_052355_material_fraction extends EDbMigration
{
	public function up()
	{
        $this->createTable(
            'material_fractions',
            array(
                'id' => 'pk',
                'title'        => 'string',
                'material_service_id' => 'int',
                'price' => 'float',
 
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
        $this->dropTable('material_fractions');
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
