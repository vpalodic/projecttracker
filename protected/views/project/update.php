<?php
    /* @var $this ProjectController */
    /* @var $model Project */
?>

<?php
	$this->breadcrumbs = array('Projects' => array('index'),
                               CHtml::encode($model->name) => array('view',
                                                                    'id' => $model->id
                                                                   ),
                               'Update'
                              );

	$this->menu = array(array('label' => 'List Projects',
							  'url' => array('index')
							 ),
						array('label' => 'Create Project',
							  'url' => array('create')
							 ),
						array('label' => 'Update Project',
							  'url' => array('update',
                                             'id' => $model->id
                                            )
							 ),
						array('label' => 'Manage Projects',
							  'url' => array('admin')
							 ),
						array('label' => 'Create New Issue',
							  'url' => array('issue/create',
							  				 'pid' => $model->id
							  				)
							 ),
					   );
?>

<h2>Update <?php echo CHtml::encode($model->name); ?></h2>

<?php $this->renderPartial('_form', array('model' => $model)); ?>