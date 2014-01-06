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
							   $model->name,
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
							  						 			   )
							  						),
							  				   array('label' => 'View Issue',
							  				   		 'url' => '#',
							  				   		 'active' => true
							  				   		),
							  				   array('label' => 'Update Issue',
							  				   		 'url' => array('update',
							  				 						'id' => $model->id
							  									   ),
							  				   		),
							  				   array('label' => 'Create Issue',
							  				   		 'url' => array('create',
							  				   		 			    'pid' => $model->project_id
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

<?php
	$this->widget('bootstrap.widgets.TbAlert');
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

<div id="comments">
	<?php if($model->commentCount >= 1): ?>
		<h3>
			<?php
				echo $model->commentCount>1 ?
					$model->commentCount . ' comments' :
					'One comment';
			?>
		</h3>
		<?php
			$this->renderPartial(
				'_comments',
				array(
					'comments' => $model->comments,
				)
			);
		?>
	<?php endif; ?>

	<h3>Leave a Comment</h3>

	<?php
		$this->renderPartial(
			'/comment/_form',
			array(
				'model' => $comment,
			)
		);
	?>
</div>
