<?php

class m140101_160135_create_project_table extends CDbMigration
{
	public function up()
	{
		// Create the project table
		$this->createTable('project',
						   array('id' => 'pk',
						    	 'name' => 'string NOT NULL',
						   		 'description' => 'text NOT NULL',
						   		 'create_time' => 'datetime DEFAULT NULL',
						   		 'create_user_id' => 'int(11) DEFAULT NULL',
						   		 'update_time' => 'datetime DEFAULT NULL',
						   		 'update_user_id' => 'int(11) DEFAULT NULL',
						   		 ),
						   'ENGINE = InnoDB DEFAULT CHARSET = utf8 AUTO_INCREMENT = 3');
	}

	public function down()
	{
		$this->dropTable('project');
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