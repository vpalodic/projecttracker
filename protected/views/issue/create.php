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
							  				   		 'disabled' => true,
							  				   		),
							  				   array('label' => 'Create Issue',
							  						 'url' => '#',
							  				   		 'active' => true,
							  						 'linkOptions' => array('submit' => array('update',
							  										   						  'pid' => $model->project_id
							  										  						 ),
							  						 						'confirm' => 'Your changes will be lost. Are you sure?'
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


<h2>Create <?php echo CHtml::encode($project->name); ?> Issue</h2>

<?php $this->renderPartial('_form', array('model' => $model)); ?>