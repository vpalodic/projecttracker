<?php

/**
 * This is the model class for table "project".
 *
 * The followings are the available columns in table 'project':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 *
 * The followings are the available model relations:
 * @property Issue[] $issues
 * @property User[] $users
 */
class Project extends ProjectTrackerActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(array('name, description',
						   'required'
						  ),
					 array('name',
					 	   'length',
					 	   'max' => 255
					 	  ),
					 // The following rule is used by search().
					 // @todo Please remove those attributes that should not be searched.
					 array('id, name, description, create_time, create_user_id, update_time, update_user_id',
					 	   'safe',
					 	   'on' => 'search'
					 	  ),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
	    // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array('issues' => array(self::HAS_MANY, 'Issue', 'project_id'),
        			 'users' => array(self::MANY_MANY, 'User', 'project_user_assignment(project_id, user_id)'),
        			);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array('id' => 'ID',
					 'name' => 'Name',
					 'description' => 'Description',
					 'create_time' => 'Create Time',
					 'create_user_id' => 'Create User',
					 'update_time' => 'Update Time',
					 'update_user_id' => 'Update User',
					);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('create_time', $this->create_time, true);
		$criteria->compare('create_user_id', $this->create_user_id);
		$criteria->compare('update_time', $this->update_time, true);
		$criteria->compare('update_user_id', $this->update_user_id);

		return new CActiveDataProvider($this, array('criteria'=>$criteria,));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Project the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * Retrieves a list of valid role options.
	 * @return array an array of valid project roles
	 */
	public static function getUserRoleOptions()
	{
		$arrRoles = CHtml::listData(Yii::app()->authManager->roles,
									'name',
									'name'
								   );

		return $arrRoles;
	}

	/**
	 * Retrieves a list of valid users for this project.
	 * @return array an array of valid project users indexed by user id.
	 */
	public function getUserOptions()	
	{
		$arrUsers = CHtml::listData($this->users,
									'id',
									'username'
								   );

		return $arrUsers;
	}	

	/**
	 * Assigns a user to the project with the passed in role.
	 * @param integer $userId the user id to be assigned to the project.
	 * @param string $role the role the user will have in the project.
	 */
	public function assignUser($userId, $role)
	{
		$command = Yii::app()->db->createCommand();

		$command->insert('project_user_assignment',
						 array('role' => $role,
						 	   'user_id' => $userId,
						 	   'project_id' => $this->id,
						 	  )
						);
	}

	/**
	 * Removes a user from the project.
	 * @param integer $userId the user id to be removed from the project.
	 */
	public function removeUser($userId)
	{
		$command = Yii::app()->db->createCommand();

		$command->delete('project_user_assignment',
						 'user_id = :userId AND project_id = :projectId',
						 array(':userId' => $userId,
						 	   ':projectId' => $this->id
						 	  )
						);
	}

	/**
	 * Checks if the current logged in user is assigned to the project
	 * in the passed in role.
	 * @param string $role the role to check that the user is a member of.
	 * @return boolean true if the user is already assigned the role in the project.
	 */
	public function allowCurrentUser($role)
	{
		$sql = "SELECT * FROM project_user_assignment ";
		$sql .= "WHERE project_id = :projectId AND user_id = :userId AND role = :role";

		$command = Yii::app()->db->createCommand($sql);
		
		$command->bindValue(":projectId",
							$this->id,
							PDO::PARAM_INT
						   );

		$command->bindValue(":userId",
							Yii::app()->user->id,
							PDO::PARAM_INT
						   );

		$command->bindValue(":role",
							$role,
							PDO::PARAM_STR
						   );

		return $command->execute() == 1;
	}

	/**
	 * Checks if the passed in user is assigned to the project.
	 * @param integer $user the role to check that the user is a member of.
	 * @return boolean true if the user is already assigned to the project.
	 */
	public function isUserInProject($user)
	{
		$sql = "SELECT user_id FROM project_user_assignment ";
		$sql .= "WHERE project_id = :projectId AND user_id = :userId";

		$command = Yii::app()->db->createCommand($sql);
		
		$command->bindValue(":projectId",
							$this->id,
							PDO::PARAM_INT
						   );

		$command->bindValue(":userId",
							$user->id,
							PDO::PARAM_INT
						   );

		return $command->execute() == 1;
	}
}
