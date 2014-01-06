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
							  'url' => array('create'),
							  'active' => true
							 ),
						array('label' => 'Manage Projects',
							  'url' => array('admin')
							 ),
					   );

	$this->menu = array(array('label' => 'Projects',
							  'items' => array(array('label' => 'List Projects',
							  						 'url' => array('index')
							  						),
							  				   array('label' => 'View Project',
							  				   		 'url' => '#',
							  				   		 'disabled' => true
							  				   		),
							  				   array('label' => 'Update Project',
							  				   		 'url' => '#',
							  				   		 'disabled' => true
							  				   		),
							  				   array('label' => 'Create Project',
							  				   		 'url' => '#',
							  				   		 'linkOptions' => array('submit' => array('create'),
							  						 						'confirm' => 'Your changes will be lost. Are you sure?'
							 											   ),
							  				   		 'active' => true
							  				   		),
							  				   array('label' => 'Delete Project',
							  				   		 'url' => '#',
							  				   		 'disabled' => true,
													),
							  				   TbHtml::menuDivider(),
							  				   array('label' => 'Manage Projects',
							  				   		 'url' => array('admin')
							  				   		),
							  				  )
							 ),
						array('label' => 'Project Issues',
							  'items' => array(),
							  'url' => '#',
							  'disabled' => true
							 ),
						array('label' => 'Project Users',
							  'items' => array(),
							  'url' => '#',
							  'disabled' => true
							 )
					   );
?>

<h2>Create Project</h2>

<?php $this->renderPartial('_form', array('model' => $model)); ?>