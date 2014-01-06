<?php

/**
 * RecentCommentsWidget class.
 * RecentCommentsWidget is a Yii widget used to display a
 * list of recent comments.
 *
 * The followings are the available public properties:
 * @property integer $displayLimit
 * @property integer $projectId
 * @property array $htmlOptions
 */
class RecentCommentsWidget extends CWidget
{
	/**
	 * @var Comment $_comments an instance of the Comment AR model class
	 */
	private $_comments;

	/**
	 * @var integer $displayLimit maximum number of comments to retrieve
	 */
	public $displayLimit = 5;

	/**
	 * @var integer $projectId the project that the issues and comments belong to
	 */
	public $projectId = null;

	/**
     * @var array the HTML attributes for the comments container.
     */
    public $htmlOptions = array();

	public function init()
	{
		// attach the yiistrap behaviors
        $this->attachBehavior('TbWidget', new TbWidget);
        $this->copyId();

		if(null !== $this->projectId) {
			$this->_comments = Comment::model()->with(
				array(
					'issue'=>array(
						'condition'=>'project_id = ' . $this->projectId
					)
				)
			)->recent($this->displayLimit)->findAll();
		}
		else {
			$this->_comments = Comment::model()->recent($this->displayLimit)->findAll();
		}
	}

	public function getData()
	{
		return $this->_comments;
	}

	public function run()
	{
		// this method is called by CController::endWidget()
		$this->render('recentCommentsWidget');
	}
}