<?php
	/* @var $this IssueController */
	/* @var $model Issue */
?>

<?php
	$this->breadcrumbs = array('Projects' => array('project/index'),
							   CHtml::encode($model->project->name) => array('project/view',
                                                                             'id' => $model->project_id
                                                                            ),
							   'Issues' => array('index',
							   					 'pid' => $model->project_id
							   					),
							   CHtml::encode($model->name),
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
						array('label' => 'Delete Issue',
							  'url' => '#',
							  'linkOptions' => array('submit' => array('delete',
							  										   'id' => $model->id
							  										  ),
							  						 'confirm' => 'Are you sure you want to delete this item?'
							  						)
							 ),
						array('label' => 'Manage Project Issues',
							  'url' => array('admin',
							   				 'pid' => $model->project_id
							   				)
							  ),
					   );
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
				  							  array('name' => 'type_id',
				  							  		'value' => CHtml::encode($model->typeText),
				  							  	   ),
				  							  array('name' => 'status_id',
				  							  		'value' => CHtml::encode($model->statusText),
				  							  	   ),
				  							  array('name' => 'owner_id',
				  							  		'value' => CHtml::encode($model->ownerText),
				  							  	   ),
				  							  array('name' => 'requester_id',
				  							  		'value' => CHtml::encode($model->requesterText),
				  							  	   ),
				  							 ),
				  	   )
				 );
?>
