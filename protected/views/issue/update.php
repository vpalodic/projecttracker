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
							   $model->name => array('view',
                                                     'id' => $model->id
                                                    ),
							   'Update',
							  );

	$this->menu = array(array('label' => 'Projects',
							  'items' => array(array('label' => 'List Projects',
							  						 'url' => array('project/index')
							  						),
							  				   array('label' => 'View Project',
							  				   		 'url' => array('project/view',
                                                                    'id' => $model->project_id
							  				   					   )
							  				   		),
							  				   array('label' => 'Update Project',
							  				   		 'url' => array('project/update',
							  										'id' => $model->project_id
																   ),
							  				   		),
							  				   array('label' => 'Create Project',
							  				   		 'url' => array('project/create')
							  				   		),
							  				   array('label' => 'Delete Project',
							  				   		 'url' => '#',
							  				   		 'disabled' => true,
													),
							  				   TbHtml::menuDivider(),
							  				   array('label' => 'Manage Projects',
							  				   		 'url' => array('project/admin')
							  				   		),
							  				  )
							 ),
						array('label' => 'Project Issues',
							  'items' => array(array('label' => 'List Issues',
							  						 'url' => array('index',
							  						 				'pid' => $model->project_id
							  						 			   ),
							  						),
							  				   array('label' => 'View Issue',
							  				   		 'url' => '#',
							  				   		 'disabled' => true
							  				   		),
							  				   array('label' => 'Update Issue',
							  						 'url' => '#',
							  				   		 'active' => true,
							  						 'linkOptions' => array('submit' => array('update',
							  										   						  'id' => $model->id
							  										  						 ),
							  						 						'confirm' => 'Your changes will be lost. Are you sure?'
							  											   )
							  				   		),
							  				   array('label' => 'Create Issue',
							  				   		 'url' => array('create',
							  				   		 			    'pid' => $model->project_id
							  				   		 			   )
							  				   		),
											   array('label' => 'Delete Issue',
							  						 'url' => '#',
							  						 'disabled' => true
							 						),
							  				   array('label' => 'Manage Issues',
							  				   		 'url' => array('admin',
							  				   		 			    'pid' => $model->project_id
							  				   		 			   )
							  				   		),
							  				  )
							 ),
						array('label' => 'Project Users',
							  'items' => array()
							 )
					   );

	if(Yii::app()->user->checkAccess('createUser',
									 array('project' => $model->project))) {
		$this->menu[2]['items'][] = array('label' => 'Add Project User',
										  'url' => array('project/adduser',
										  				 'id' => $model->project_id
							 			  				)
							 			 );
	} else {
		$this->menu[2]['url'] = '#';
		$this->menu[2]['disabled'] = true;
	}
?>

<h2>Update <?php echo CHtml::encode($model->name); ?></h2>

<?php $this->renderPartial('_form', array('model' => $model)); ?>