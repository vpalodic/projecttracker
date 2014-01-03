<?php
    /* @var $this UserController */
    /* @var $model User */
?>

<?php
    $this->breadcrumbs = array('Users'=>array('index'),
                               'Create',
                              );

	$this->menu = array(array('label' => 'List Users',
							  'url' => array('index')
							 ),
						array('label' => 'Create User',
							  'url' => array('create')
							 ),
						array('label' => 'Manage Users',
							  'url' => array('admin')
							 ),
					   );
?>

<h2>Create User</h2>

<?php $this->renderPartial('_form', array('model' => $model)); ?>