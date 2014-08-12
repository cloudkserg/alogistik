<?php

class m120524_044244_user extends CDbMigration
{
    /**
     * 
     * @return boolean
     */
	public function up()
	{
        $this->createTable(
            'users',
            array_merge(
                CmsTable::columns(),
                array(
                    'login'     => 'varchar(512)',
                    'fullname'  => 'varchar(512)',
                    'phone'     => 'varchar(512)',
                    'desc'      => 'varchar(512)',
                    'password'  => 'varchar(512)',
                    'admin'     => 'int'
                )
            ),
            'DEFAULT CHARSET utf8'
        );
        return true;
	}

    /**
     * 
     * @return boolean
     */
	public function down()
	{
        $this->dropTable('users');
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
