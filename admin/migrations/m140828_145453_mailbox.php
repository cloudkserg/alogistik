<?php

class m140828_145453_mailbox extends EDbMigration
{
	public function up()
	{
        $this->createTable(
            'mailboxes',
            array(
                'id' => 'pk',
                'sort' => 'int not null',
                'published' => 'int not null',
                'created' => 'int',
                'modified' => 'int',
                'title' => 'string',
                'mail' => 'string'
            ),
            'DEFAULT CHARSET utf8'

        );
	}

	public function down()
	{
        $this->dropTable('mailboxes');
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
