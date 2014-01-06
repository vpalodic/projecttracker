<?php

class m140106_205233_create_system_messages_table extends CDbMigration
{
	public function up()
	{
		// create the sys_message table
		$this->createTable('sys_message',
						   array('id' => 'pk',
						   		 'message' => 'text NOT NULL',
						   		 'create_time' => 'datetime DEFAULT NULL',
						   		 'create_user_id' => 'int(11) DEFAULT NULL',
						   		 'update_time' => 'datetime DEFAULT NULL',
						   		 'update_user_id' => 'int(11) DEFAULT NULL',
						   		), 'ENGINE = InnoDB DEFAULT CHARSET = utf8');

		// the sys_message.create_user_id is a reference to user.id
		$this->addForeignKey("fk_sys_message_owner",
							 "sys_message",
							 "create_user_id",
							 "user",
							 "id",
							 "CASCADE",
							 "RESTRICT"
							);

		// the sys_message.updated_user_id is a reference to user.id
		$this->addForeignKey("fk_sys_message_update_user",
							 "sys_message",
							 "update_user_id",
							 "user",
							 "id",
							 "CASCADE",
							 "RESTRICT"
							);

		// create an index on the update_time field as we use this to sort results
		$this->createIndex("idx_sys_message_update_time",
						"sys_message",
						"update_time"
					   );
	}

	public function down()
	{
		$this->dropForeignKey('fk_sys_message_owner',
							  'sys_message'
							 );

		$this->dropForeignKey('fk_sys_message_update_user',
							  'sys_message'
							 );

		$this->dropIndex('idx_sys_message_update_time',
						 'sys_message'
						);

		$this->dropTable('sys_message');
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