<?php
	/* @var $this ProjectController */
	/* @var $model Project */
?>

<?php
	$this->breadcrumbs = array('Projects' => array('index'),
                               $model->name,
                              );

	$this->menu = array(array('label' => 'Projects',
							  'items' => array(array('label' => 'List Projects',
							  						 'url' => array('index')
							  						),
							  				   array('label' => 'View Project',
							  				   		 'url' => '#',
							  				   		 'active' => true
							  				   		),
							  				   array('label' => 'Create Project',
							  				   		 'url' => array('create')
							  				   		),
							  				   array('label' => 'Update Project',
							  				   		 'url' => array('update',
							  				   		 				'id' => $model->id
							  				   		 			   )
							  				   		),
							  				   array('label' => 'Delete Project',
							  				   		 'url' => '#',
							  				   		 'linkOptions' => array('submit' => array('delete',
							  				   		 										  'id' => $model->id
							  				   		 										 ),
							  						 						'confirm' => 'Are you sure you want to delete this item?'
							 											   )
													),
							  				   TbHtml::menuDivider(),
							  				   array('label' => 'Manage Projects',
							  				   		 'url' => array('admin')
							  				   		),
							  				  )
							 ),
						array('label' => 'Project Issues',
							  'items' => array(array('label' => 'List Issues',
							  						 'url' => array('issue/index',
							  						 				'pid' => $model->id
							  						 			   )
							  						),
							  				   array('label' => 'View Issue',
							  				   		 'url' => '#',
							  				   		 'disabled' => true
							  				   		),
							  				   array('label' => 'Update Issue',
							  				   		 'url' => '#',
							  				   		 'disabled' => true
							  				   		),
							  				   array('label' => 'Create Issue',
							  				   		 'url' => array('issue/create',
							  				   		 			    'pid' => $model->id
							  				   		 			   )
							  				   		),
											   array('label' => 'Delete Issue',
							  						 'url' => '#',
							  						 'disabled' => true
							 						),
							  				   array('label' => 'Manage Issues',
							  				   		 'url' => array('issue/admin',
							  				   		 			    'pid' => $model->id
							  				   		 			   )
							  				   		),
							  				  )
							 ),
						array('label' => 'Project Users',
							  'items' => array()
							 )
					   );

	if(Yii::app()->user->checkAccess('createUser',
									 array('project' => $model))) {
		$this->menu[2]['items'][] = array('label' => 'Add Project User',
										  'url' => array('adduser',
										  				 'id' => $model->id
							 			  				)
							 			 );
	} else {
		$this->menu[2]['url'] = '#';
		$this->menu[2]['disabled'] = true;
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
				  							  array('name' => 'create_user_id',
				  							  		'value' => CHtml::encode($model->creatorText),
				  							  	   ),
				  							  'create_time',
				  							  array('name' => 'update_user_id',
				  							  		'value' => CHtml::encode($model->updaterText),
				  							  	   ),
				  							  'update_time',
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

	$this->beginWidget('zii.widgets.CPortlet',
                               array('title' => 'Recent Comments',
                                    )
                              );

		$this->widget(
			'RecentCommentsWidget',
			array(
				'projectId' => $model->id
			)
		);

	$this->endWidget();
?>
