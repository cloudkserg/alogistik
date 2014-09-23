<?php

class m140923_152427_car_services_min_order extends EDbMigration
{
	public function up()
	{
        $this->addColumn('car_services', 'min_order', 'text');
	}

	public function down()
    {
        $this->dropColumn('car_services', 'min_order');
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
