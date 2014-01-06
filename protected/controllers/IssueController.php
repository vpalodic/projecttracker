<?php

class IssueController extends Controller
{
	/**
	 * @var private property containing the associated Project model
	 * instance.
	 */
	private $_project = null;

	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array('accessControl', // perform access control for CRUD operations
					 'postOnly + delete', // we only allow deletion via POST request
					 'projectContext + index create admin', // check to ensure proper project context
					);
	}

	/**
	 * @desc Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$issue = $this->loadModel($id, true);
		$comment = $this->createComment($issue);

		$this->render(
			'view',
			array(
				'model' => $issue,
				'comment' => $comment,
			)
		);
	}

	/**
	 * @desc Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Issue;
		$model->project_id = $this->_project->id;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Issue'])) {
			$model->attributes = $_POST['Issue'];
			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create',
					  array('model' => $model,
					  		'project' => $this->_project,
                           )
                     );
	}

	/**
	 * @desc Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Issue'])) {
			$model->attributes = $_POST['Issue'];
			if($model->save()) {
				$this->redirect(array('view',
									  'id' => $model->id
									 )
							   );
			}
		}

		$this->render('update',
					  array('model' => $model,
					  	   )
					 );
	}

	/**
	 * @desc Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			}
		} else {
			throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
		}
	}

	/**
	 * @desc Lists all models.
	 */
	public function actionIndex()
	{
		$criteria = new CDbCriteria(array('order' => 'create_time desc',
										  'condition' => 'project_id = :projectId',
										  'params' => array(':projectId' => $this->_project->id),
										 )
								   );

		$dataProvider = new CActiveDataProvider('Issue',
												array('criteria' => $criteria)
											   );
			
		$this->render('index',
					  array('dataProvider' => $dataProvider,
					  		'project' => $this->_project
					  	   )
                     );
	}

	/**
	 * @desc Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new Issue('search');

		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['Issue'])) {
			$model->attributes = $_GET['Issue'];
		}

		$model->project_id = $this->_project->id;

		$this->render('admin',
					  array('model' => $model,
					  	   )
					 );
	}

	/**
	 * @desc Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Issue the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id, $withComments = false)
	{
		if($withComments) {
			$model = Issue::model()->with(array('comments' => array('with'=>'author')))->findByPk($id);
		} else {
			$model = Issue::model()->findByPk($id);
		}

		if($model === null) {
			throw new CHttpException(404, 'The requested issue does not exist.');
		}

		return $model;
	}

	/**
	 * @desc Returns the project model based on the primary key given in the GET variable.
	 * If the project model is not found, an HTTP exception will be raised.
	 * @param integer $projectId the ID of the project to be loaded
	 * @return Project the loaded project
	 * @throws CHttpException
	 */
	protected function loadProject($projectId)
	{
		// If the project property is null, created based on the passed in id
		if($this->_project === null) {
			$this->_project = Project::model()->findByPk($projectId);
	
			if($this->_project === null) {
				throw new CHttpException(404, 'The requested project does not exist.');
			}
		}

		return $this->_project;
	}

	/**
	 * @desc Performs the AJAX validation.
	 * @param Issue $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'issue-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/**
	 * @desc In-class defined filter method, configured for use in the above filters()
	 * method. It is called before the admin, create, and index actions are run in order 
	 * to ensures a proper project context has been set.
	 * @param FilterChain $filterChain the chain of filters
	 */
	public function filterProjectContext($filterChain)
	{
		// Set the project identifier based on GET input request variables
		if(isset($_GET['pid'])) {
			$this->loadProject($_GET['pid']);
		} else {
			throw new CHttpException(400, 'Bad request. You must specify a valid project before performing this action');
		}

		// Run the other filters and execute the requested action
		$filterChain->run();
	}

	/**
	 * @desc Hangles the post-back from the Issue View controller action.
	 * @param Issue $issue
	 * @return Comment the newly created comment
	 */
	protected function createComment($issue)
	{
		$comment = new Comment;

		if(isset($_POST['Comment'])) {
			$comment->attributes = $_POST['Comment'];

			if($issue->addComment($comment)) {
				Yii::app()->user->setFlash(
					TbHtml::ALERT_COLOR_INFO,
					"Your comment has been added."
				);

				$this->refresh();
			}
		}

		return $comment;
	}
}