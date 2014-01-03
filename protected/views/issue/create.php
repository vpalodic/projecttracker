<?php
	/* @var $this IssueController */
	/* @var $model Issue */
    /* @var $project Project */
?>

<?php
	$this->breadcrumbs = array('Projects' => array('project/index'),
							   $project->name => array('project/view',
							   						   'id' => $project->id
							   						  ),
							   'Issues' => array('index',
							   					 'pid' => $project->id
							   					),
							   'Create',
							  );

	$this->menu = array(array('label' => 'List Project Issues',
							  'url' => array('index',
							   				 'pid' => $project->id
							   				)
							 ),
						array('label' => 'Manage Project Issues',
							  'url' => array('admin',
							   				 'pid' => $project->id
							   				)
							  ),
					   );
?>


<h2>Create <?php echo CHtml::encode($project->name); ?> Issue</h2>

<?php $this->renderPartial('_form', array('model' => $model)); ?>