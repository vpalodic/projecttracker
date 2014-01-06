<?php
    /* @var $this ProjectController */
    /* @var $model Project */
?>

<?php
	$this->breadcrumbs = array('Projects' => array('index'),
                               $model->name => array('view',
                                                     'id' => $model->id
                                                    ),
                               'Update'
                              );

	$this->menu = array(array('label' => 'Projects',
							  'items' => array(array('label' => 'List Projects',
							  						 'url' => array('index')
							  						),
							  				   array('label' => 'View Project',
							  				   		 'url' => array('view',
                                                                    'id' => $model->id
							  				   					   )
							  				   		),
							  				   array('label' => 'Update Project',
							  				   		 'url' => '#',
							  				   		 'linkOptions' => array('submit' => array('update',
							  										   						  'id' => $model->id
							  										  						 ),
							  						 						'confirm' => 'Your changes will be lost. Are you sure?'
							 											   ),
							  				   		 'active' => true
							  				   		),
							  				   array('label' => 'Create Project',
							  				   		 'url' => array('create')
							  				   		),
							  				   array('label' => 'Delete Project',
							  				   		 'url' => '#',
							  				   		 'disabled' => true,
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

<h2>Update <?php echo CHtml::encode($model->name); ?></h2>

<?php $this->renderPartial('_form', array('model' => $model)); ?>