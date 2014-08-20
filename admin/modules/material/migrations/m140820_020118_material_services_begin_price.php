<?php

class m140820_020118_material_services_begin_price extends EDbMigration
{
	public function up()
	{
        $this->alterColumn('material_services', 'begin_price', 'string');
	}

	public function down()
	{
        return true;
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
