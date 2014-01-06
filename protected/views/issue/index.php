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

	$this->menu = array(array('label' => 'Projects',
							  'items' => array(array('label' => 'List Projects',
							  						 'url' => array('project/index')
							  						),
							  				   array('label' => 'View Project',
							  				   		 'url' => array('project/view',
                                                                    'id' => $project->id
							  				   					   )
							  				   		),
							  				   array('label' => 'Update Project',
							  				   		 'url' => array('project/update',
							  										'id' => $project->id
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
							  						 				'pid' => $project->id
							  						 			   ),
							  				   		 'active' => true
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
							  				   		 'url' => array('create',
							  				   		 			    'pid' => $project->id
							  				   		 			   )
							  				   		),
											   array('label' => 'Delete Issue',
							  						 'url' => '#',
							  						 'disabled' => true
							 						),
							  				   array('label' => 'Manage Issues',
							  				   		 'url' => array('admin',
							  				   		 			    'pid' => $project->id
							  				   		 			   )
							  				   		),
							  				  )
							 ),
						array('label' => 'Project Users',
							  'items' => array()
							 )
					   );

	if(Yii::app()->user->checkAccess('createUser',
									 array('project' => $project))) {
		$this->menu[2]['items'][] = array('label' => 'Add Project User',
										  'url' => array('project/adduser',
										  				 'id' => $project->id
							 			  				)
							 			 );
	} else {
		$this->menu[2]['url'] = '#';
		$this->menu[2]['disabled'] = true;
	}
?>

<h2><?php echo CHtml::encode($project->name); ?> Issues</h2>

<?php
	$this->widget('bootstrap.widgets.TbListView',
				  array('dataProvider' => $dataProvider,
				  		'itemView' => '_view',
				  	   )
                 );
?>