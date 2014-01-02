<?php

class m140101_195433_create_issue_user_and_assignment_tables extends CDbMigration
{
/*
	public function up()
	{
	}

	public function down()
	{
	}
*/
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
		// Create the issue table
		$this->createTable('issue',
						   array('id' => 'pk',
						    	 'name' => 'string NOT NULL',
						   		 'description' => 'text NOT NULL',
						   		 'project_id' => 'int(11) DEFAULT NULL',
						   		 'type_id' => 'int(11) DEFAULT NULL',
						   		 'status_id' => 'int(11) DEFAULT NULL',
						   		 'owner_id' => 'int(11) DEFAULT NULL',
						   		 'requester_id' => 'int(11) DEFAULT NULL',
						   		 'create_time' => 'datetime DEFAULT NULL',
						   		 'create_user_id' => 'int(11) DEFAULT NULL',
						   		 'update_time' => 'datetime DEFAULT NULL',
						   		 'update_user_id' => 'int(11) DEFAULT NULL',
						   		 ),
						   'ENGINE = InnoDB DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1');

		// Create the user table
		$this->createTable('user',
						   array('id' => 'pk',
						    	 'username' => 'string NOT NULL',
						   		 'email' => 'string NOT NULL',
						   		 'password' => 'string NOT NULL',
						   		 'last_login_time' => 'datetime DEFAULT NULL',
						   		 'create_time' => 'datetime DEFAULT NULL',
						   		 'create_user_id' => 'int(11) DEFAULT NULL',
						   		 'update_time' => 'datetime DEFAULT NULL',
						   		 'update_user_id' => 'int(11) DEFAULT NULL',
						   		 ),
						   'ENGINE = InnoDB DEFAULT CHARSET = utf8 AUTO_INCREMENT = 5');

		// Create the assignment table that allows for
		// many-to-many relationship between projects and users
		$this->createTable('project_user_assignment',
						   array('project_id' => 'int(11) NOT NULL',
						    	 'user_id' => 'int(11) NOT NULL',
						   		 'PRIMARY KEY (`project_id`, `user_id`)',
						   		 ),
						   'ENGINE = InnoDB DEFAULT CHARSET = utf8');

		// Foreign key relationships

		// issue.project_id is a reference to project.id
		$this->addForeignKey('fk_issue_project',
							 'issue',
							 'project_id',
							 'project',
							 'id',
							 'CASCADE',
							 'RESTRICT');

		// issue.owner_id is a reference to user.id
		$this->addForeignKey('fk_issue_owner',
							 'issue',
							 'owner_id',
							 'user',
							 'id',
							 'CASCADE',
							 'RESTRICT');

		// issue.requester_id is a reference to user.id
		$this->addForeignKey('fk_issue_requester',
							 'issue',
							 'requester_id',
							 'user',
							 'id',
							 'CASCADE',
							 'RESTRICT');

		// project_user_assignment.project_id is a reference to project.id
		$this->addForeignKey('fk_project_user_assignment_project',
							 'project_user_assignment',
							 'project_id',
							 'project',
							 'id',
							 'CASCADE',
							 'RESTRICT');

		// project_user_assignment.user_id is a reference to user.id
		$this->addForeignKey('fk_project_user_assignment_user',
							 'project_user_assignment',
							 'user_id',
							 'user',
							 'id',
							 'CASCADE',
							 'RESTRICT');
	}

	public function safeDown()
	{
		$this->truncateTable('project_user_assignment');		
		$this->truncateTable('issue');		
		$this->truncateTable('user');		
		$this->dropTable('project_user_assignment');		
		$this->dropTable('issue');		
		$this->dropTable('user');		
	}
}