<?php
/* @var $this IssueController */
/* @var $model Issue */
?>

<?php
	$this->breadcrumbs = array('Projects' => array('project/index'),
							   $model->project->name => array('project/view',
												   'id' => $model->project_id
												  ),
							   'Issues' => array('index',
							   							 'pid' => $model->project_id
							   							),
							   $model->name => array('view', 'id' => $model->id),
							   'Update',
							  );

	$this->menu = array(array('label' => 'List Project Issues',
							  'url' => array('index',
							   				 'pid' => $model->project_id
							   				)
							 ),
						array('label' => 'New Project Issue',
							  'url' => array('create',
							  				 'pid' => $model->project_id
							  				)
							 ),
						array('label' => 'Update Issue',
							  'url' => array('update',
							  				 'id' => $model->id
							  				)
							 ),
						array('label' => 'Manage Project Issues',
							  'url' => array('admin',
							   				 'pid' => $model->project_id
							   				)
							  ),
					   );
?>

<h2>Update <?php echo CHtml::encode($model->name); ?></h2>

<?php $this->renderPartial('_form', array('model' => $model)); ?>