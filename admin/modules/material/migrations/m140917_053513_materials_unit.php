<?php

class m140917_053513_materials_unit extends EDbMigration
{
	public function up()
	{
        $this->addColumn('material_services', 'unit', 'int not null');
	}

    public function down()
    {
        $this->dropColumn('material_services', 'unit');
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
