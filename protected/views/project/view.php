<?php
	/* @var $this ProjectController */
	/* @var $model Project */
?>

<?php
	$this->breadcrumbs = array('Projects' => array('index'),
                               CHtml::encode($model->name),
                              );

	$this->menu = array(array('label' => 'List Projects',
							  'url' => array('index')
							 ),
						array('label' => 'Create Project',
							  'url' => array('create')
							 ),
						array('label' => 'Update Project',
							  'url' => array('update',
                                             'id' => $model->id)
							 ),
						array('label' => 'Delete Project',
							  'url' => '#',
							  'linkOptions' => array('submit' => array('delete',
							  										   'id' => $model->id
							  										  ),
							  						 'confirm' => 'Are you sure you want to delete this item?'
							 						)
							 ),
						array('label' => 'Manage Projects',
							  'url' => array('admin')
							 ),
						array('label' => 'View Issues',
							  'url' => array('issue/index',
							  				 'pid' => $model->id
							  				)
							 ),
						array('label' => 'Create New Issue',
							  'url' => array('issue/create',
							  				 'pid' => $model->id
							  				)
							 ),
					   );

	if(Yii::app()->user->checkAccess('createUser',
									 array('project' => $model))) {
		$this->menu[] = array('label' => 'Add Project User',
							  'url' => array('adduser', 'id' => $model->id
							 			  )
							 );
	}

?>

<h2><?php echo CHtml::encode($model->name); ?> Details</h2>

<?php
	$this->widget('yiiwheels.widgets.detail.WhDetailView',
				  array('type' => array(TbHtml::GRID_TYPE_STRIPED,
				  						TbHtml::GRID_TYPE_BORDERED,
				  						TbHtml::GRID_TYPE_CONDENSED,
				  						TbHtml::GRID_TYPE_HOVER),
				  		'data' => $model,
				  		'attributes' => array('id',
				  							  'name',
				  							  'description',
				  							  'create_time',
				  							  'create_user_id',
				  							  'update_time',
				  							  'update_user_id',
				  							 ),
				  	   )
				 );
?>

<br>

<h3><?php echo CHtml::encode($model->name); ?> Issues</h3>

<?php
	$this->widget('bootstrap.widgets.TbListView',
				  array('dataProvider' => $issueDataProvider,
				  		'itemView' => '/issue/_view',
				  	   )
				 );
?>
