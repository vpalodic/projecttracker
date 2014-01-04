<?php

/**
 * ProjectUserForm class.
 * ProjectUserForm is the data structure for keeping
 * user and role assignments for projects.
 * It is used by the 'adduser' action of 'ProjectController'.
 *
 * The followings are the available public properties:
 * @property string $username
 * @property string $role
 * @property Project $project
 */
class ProjectUserForm extends CFormModel
{
	/**
	 * @var string username of the user being added to the project
	 */
	public $username;
	
	/**
	 * @var string the role to which the user will be associated within the project
	 */
	public $role; 
	
	/**
	 * @var object an instance of the Project AR model class
	 */ 
	public $project;
	
    /**
	 * @var object an instance of the User AR model class
	 */ 
	private $_user;
	
	/**
	 * Declares the validation rules.
	 * The rules state that username and role are required,
	 * and username needs to be verified.
	 */
	public function rules()
	{
		return array(
			// username and role are required
			array('username, role',
                  'required'
                 ),
            //username needs to be checked for existence 
			array('username',
                  'exist',
                  'className' => 'User'
                 ),
			// username needs to be verified
			array('username', 'verify'),
		);
	}

	/**
	 * Authenticates the existence of the user in the system.
	 * If valid, it will also make the association between the user,
     * role and project.
	 * This is the 'verify' validator as declared in rules().
	 */
	public function verify($attribute, $params)
	{
        // we only want to authenticate when no other input errors are present
		if(!$this->hasErrors()) {
			$user = User::model()->findByAttributes(array('username' => $this->username));

	        if($this->project->isUserInProject($user)) {
				$this->addError('username', 'This user has already been added to the project.');
			}
			else {
				$this->_user = $user;
			}
		}
	}

	/**
	 * If user is valid, it will make the association between the user,
     * role and project.
	 */
	public function assign()
	{
		if($this->_user instanceof User) {
			// Assign the user, in the specified role, to the project
			$this->project->assignUser($this->_user->id, $this->role);
            
			// Add the association, along with the RBAC biz rule,
            // to our RBAC hierarchy
	        $auth = Yii::app()->authManager;
            
			$bizRule = 'return isset($params["project"]) && ';
            $bizRule .= '$params["project"]->allowCurrentUser("' . $this->role . '");';
            
			$auth->assign($this->role, $this->_user->id, $bizRule);
            
			return true;
		}
		else {
			$this->addError('username', 'Error when attempting to assign this user to the project.'); 
			return false;
		}		
	}

	/**
	 * Generates an array of usernames to use for the autocomplete
	 */
	public function getUsernameList()
	{
		$sql = "SELECT username FROM user";
		
        $command = Yii::app()->db->createCommand($sql);
		
        $rows = $command->queryAll();
        
		//format it for use with auto complete widget
		$usernames = array();
		
        foreach($rows as $row) {
			$usernames[] = $row['username'];
		}
        
		return $usernames;		
	}
}
