<?php

class m140916_013421_material_fractions_use_fraction extends EDbMigration
{
	public function up()
	{
        $this->addColumn('material_services', 'use_fraction', 'int not null');
	}

	public function down()
	{
        $this->dropColumn('material_services', 'use_fraction');
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
