<?php
    /* @var $this UserController */
    /* @var $model User */
?>

<?php
	$this->breadcrumbs = array('Users' => array('index'),
                               CHtml::encode($model->username),
                              );

	$this->menu = array(array('label' => 'List Users',
							  'url' => array('index')
							 ),
						array('label' => 'Create User',
							  'url' => array('create')
							 ),
						array('label' => 'Update User',
							  'url' => array('update',
                                             'id' => $model->id
                                            )
							 ),
						array('label' => 'Delete User',
							  'url' => '#',
							  'linkOptions' => array('submit' => array('delete',
							  										   'id' => $model->id
							  										  ),
							  						 'confirm' => 'Are you sure you want to delete this item?'
							 						)
							 ),
						array('label' => 'Manage Users',
							  'url' => array('admin')
							 ),
					   );
?>

<h2><?php echo CHtml::encode($model->username); ?> Details</h2>

<?php
	$this->widget('yiiwheels.widgets.detail.WhDetailView',
				  array('type' => array(TbHtml::GRID_TYPE_STRIPED,
				  						TbHtml::GRID_TYPE_BORDERED,
				  						TbHtml::GRID_TYPE_CONDENSED,
				  						TbHtml::GRID_TYPE_HOVER),
				  		'data' => $model,
				  		'attributes' => array('id',
                                              'username',
                                              'email',
                                              'last_login_time',
				  							  'create_time',
				  							  'create_user_id',
				  							  'update_time',
				  							  'update_user_id',
				  							 ),
				  	   )
				 );
?>