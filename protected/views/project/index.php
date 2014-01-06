<?php
	/* @var $this ProjectController */
	/* @var $dataProvider CActiveDataProvider */
?>

<?php
	$this->breadcrumbs = array('Projects',);

	$this->menu = array(array('label' => 'Projects',
							  'items' => array(array('label' => 'List Projects',
							  						 'url' => array('index'),
							  				   		 'active' => true
							  						),
							  				   array('label' => 'View Project',
							  				   		 'url' => '#',
							  				   		 'disabled' => true,
							  				   		),
							  				   array('label' => 'Create Project',
							  				   		 'url' => array('create')
							  				   		),
							  				   array('label' => 'Update Project',
							  				   		 'url' => '#',
							  				   		 'disabled' => true,
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

<h2>Projects</h2>

<?php
	$this->widget('bootstrap.widgets.TbListView',
				  array('dataProvider' => $dataProvider,
				  		'itemView' => '_view',
				  	   )
				 );

	$this->beginWidget('zii.widgets.CPortlet',
                               array('title' => 'Recent Comments',
                                    )
                              );

		$this->widget('RecentCommentsWidget');

	$this->endWidget();
?>