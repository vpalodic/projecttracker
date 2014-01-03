<?php
    /* @var $this UserController */
    /* @var $model User */
?>

<?php
	$this->breadcrumbs = array('Users' => array('index'),
                               CHtml::encode($model->username) => array('view',
                                                                        'id' => $model->id
                                                                       ),
                               'Update'
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
						array('label' => 'Manage Users',
							  'url' => array('admin')
							 ),
					   );
?>

<h2>Update <?php echo CHtml::encode($model->username); ?></h2>

<?php $this->renderPartial('_form', array('model' => $model)); ?>