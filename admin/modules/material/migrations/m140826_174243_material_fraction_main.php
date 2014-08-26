<?php

class m140826_174243_material_fraction_main extends EDbMigration
{
	public function up()
	{
        $this->addColumn('material_fractions', 'main', 'int not null');
	}

	public function down()
    {
        $this->dropColumn('material_fractions', 'main');
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
