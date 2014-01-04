<?php

class m140103_052302_add_role_to_project_user_assignment extends CDbMigration
{
	public function up()
	{
		$this->addColumn('project_user_assignment',
						 'role',
						 'varchar(64)'
						);
		
		// the project_user_assignment.role is a reference
		// to auth_item.name
		$this->addForeignKey('fk_project_user_role',
							 'project_user_assignment',
							 'role',
							 'auth_item',
							 'name',
							 'CASCADE',
							 'CASCADE'
							);
	}

	public function down()
	{
		$this->dropForeignKey('fk_project_user_role',
							  'project_user_assignment'
							 );

		$this->dropColumn('project_user_assignment',
						  'role');
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