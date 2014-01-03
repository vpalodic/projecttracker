<?php
	/* @var $this IssueController */
	/* @var $dataProvider CActiveDataProvider */
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
							  );

	$this->menu = array(array('label' => 'List Project Issues',
							  'url' => array('index',
							   				 'pid' => $project->id
							   				)
							 ),
						array('label' => 'New Project Issue',
							  'url' => array('create',
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

<h2><?php echo CHtml::encode($project->name); ?> Issues</h2>

<?php
	$this->widget('bootstrap.widgets.TbListView',
				  array('dataProvider' => $dataProvider,
				  		'itemView' => '_view',
				  	   )
                 );
?>