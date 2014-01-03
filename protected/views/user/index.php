<?php
    /* @var $this UserController */
    /* @var $dataProvider CActiveDataProvider */
?>

<?php
	$this->breadcrumbs = array('Users',);

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

<h2>Users</h2>

<?php
	$this->widget('bootstrap.widgets.TbListView',
				  array('dataProvider' => $dataProvider,
				  		'itemView' => '_view',
				  	   )
				 );
?>