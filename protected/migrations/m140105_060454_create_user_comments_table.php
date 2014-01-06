<?php

class m140105_060454_create_user_comments_table extends CDbMigration
{
	public function up()
	{
		// create the issue table
		$this->createTable('comment',
						   array('id' => 'pk',
						   		 'content' => 'text NOT NULL',
						   		 'issue_id' => 'int(11) NOT NULL',
						   		 'create_time' => 'datetime DEFAULT NULL',
						   		 'create_user_id' => 'int(11) DEFAULT NULL',
						   		 'update_time' => 'datetime DEFAULT NULL',
						   		 'update_user_id' => 'int(11) DEFAULT NULL',
						   		), 'ENGINE=InnoDB');

		// the comment.issue_id is a reference to issue.id
		$this->addForeignKey("fk_comment_issue",
							 "comment",
							 "issue_id",
							 "issue",
							 "id",
							 "CASCADE",
							 "RESTRICT"
							);
		
		// the issue.create_user_id is a reference to user.id
		$this->addForeignKey("fk_comment_owner",
							 "comment",
							 "create_user_id",
							 "user",
							 "id",
							 "RESTRICT",
							 "RESTRICT"
							);

		// the issue.updated_user_id is a reference to user.id
		$this->addForeignKey("fk_comment_update_user",
							 "comment",
							 "update_user_id",
							 "user",
							 "id",
							 "RESTRICT",
							 "RESTRICT"
							);
	}

	public function down()
	{
		$this->dropForeignKey('fk_comment_issue',
							  'comment'
							 );

		$this->dropForeignKey('fk_comment_owner',
							  'comment'
							 );

		$this->dropForeignKey('fk_comment_update_user',
							  'comment'
							 );

		$this->dropTable('comment');
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