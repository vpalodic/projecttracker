<?php
	/* @var $this IssueController */
	/* @var $model Issue */
?>

<?php
	$project = $this->loadProject($_GET['pid']);

	$this->breadcrumbs = array('Projects' => array('project/index'),
							   $project->name => array('project/view',
							   						   'id' => $project->id
							   						  ),
							   'Issues' => array('index',
							   					 'pid' => $project->id
							   					),
							   'New',
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


<h2>New <?php echo CHtml::encode($project->name); ?> Issue</h2>

<?php $this->renderPartial('_form', array('model' => $model)); ?>