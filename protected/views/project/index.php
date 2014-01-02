<?php
	/* @var $this ProjectController */
	/* @var $dataProvider CActiveDataProvider */
?>

<?php
	$this->breadcrumbs = array('Projects',);

	$this->menu = array(array('label' => 'Create Project',
							  'url' => array('create')
							 ),
						array('label' => 'Manage Projects',
							  'url' => array('admin')
							 ),
					   );
?>

<h2>Projects</h2>

<?php
	$this->widget('bootstrap.widgets.TbListView',
				  array('dataProvider' => $dataProvider,
				  		'itemView' => '_view',
				  	   )
				 );
?>