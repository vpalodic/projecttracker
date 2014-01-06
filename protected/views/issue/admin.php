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
							   'Manage',
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
						array('label' => 'Manage Project Issues',
							  'url' => array('admin',
							   				 'pid' => $model->project_id
							   				)
							  ),
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
							  				   		 			   ),
							  				   		 'active' => true
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

    Yii::app()->clientScript->registerScript('search',
                                             "$('.search-button').click(function()
                                             {
                                                $('.search-form').toggle();
                                                return false;
                                             });
                                             
                                             $('.search-form form').submit(function()
                                             {
                                                $('#user-grid').yiiGridView('update',
                                                {
                                                    data: $(this).serialize()
                                                });
                                                
                                                return false;
                                             });
                                             ");
?>

<h2>Manage <?php echo CHtml::encode($model->project->name); ?> Issues</h2>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>,
    <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the beginning of
    each of your search values to specify how the comparison should be done.
</p>

<p>
    <?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button btn')); ?>
</p>

<div class="search-form" style="display:none">
    <?php
        $this->renderPartial('_search',
                             array('model' => $model,
                                  )
                            );
    ?>
</div><!-- search-form -->

<?php
	$this->widget('bootstrap.widgets.TbGridView',
				  array('id' => 'issue-grid',
				  		'type' => array(TbHtml::GRID_TYPE_STRIPED,
				  						TbHtml::GRID_TYPE_BORDERED,
				  						TbHtml::GRID_TYPE_CONDENSED,
				  						TbHtml::GRID_TYPE_HOVER),
				  		'dataProvider' => $model->search(),
				  		'filter' => $model,
				  		'columns' => array('id',
				  						   'name',
				  						   'description',
				  						   'type_id',
				  						   'status_id',
				  						   'owner_id',
				  						   'requester_id',
/*                                         'create_time',
                                           'create_user_id',
                                           'update_time',
                                           'update_user_id',
*/										   array('header' => 'Edit',
										   		 'class'=>'bootstrap.widgets.TbButtonColumn',
                                                ),
                                          ),
                       )
                 );
?>