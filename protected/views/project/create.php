<?php
    /* @var $this ProjectController */
    /* @var $model Project */
?>

<?php
    $this->breadcrumbs = array('Projects'=>array('index'),
                               'Create',
                              );

	$this->menu = array(array('label' => 'List Projects',
							  'url' => array('index')
							 ),
						array('label' => 'Create Project',
							  'url' => array('create')
							 ),
						array('label' => 'Manage Projects',
							  'url' => array('admin')
							 ),
					   );
?>

<h2>Create Project</h2>

<?php $this->renderPartial('_form', array('model' => $model)); ?>