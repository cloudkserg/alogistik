<?php

class m121219_065801_page extends EDbMigration
{
        /**
         * 
         * @return boolean
         */
	public function up()
	{
            $this->createTable(
                'pages',
                array(
                    'id' => 'pk',
                    'title'        => 'string',
                    'text'         => 'longtext',
                    'type' => 'int',
                    'created' => 'int',
                    'modified' => 'int',
                    'sort' => 'int not null',
                    'published' => 'int not null'
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
            $this->dropTable('pages');
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
