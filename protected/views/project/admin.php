<?php
    /* @var $this ProjectController */
    /* @var $model Project */
?>

<?php
	$this->breadcrumbs = array('Projects' => array('project/index'),
                             'Manage',
                            );

  $this->menu = array(array('label' => 'Projects',
                            'items' => array(array('label' => 'List Projects',
                                                   'url' => array('index'),
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
                                                   'url' => '#',
                                                   'active' => true
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

    Yii::app()->clientScript->registerScript('search',
                                             "$('.search-button').click(function()
                                             {
                                                $('.search-form').toggle();
                                                return false;
                                             });
                                             
                                             $('.search-form form').submit(function()
                                             {
                                                $('#user-grid').yiiGridView('update',
                                                {
                                                    data: $(this).serialize()
                                                });
                                                
                                                return false;
                                             });
                                             ");
?>

<h2>Manage Projects</h2>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>,
    <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the beginning of
    each of your search values to specify how the comparison should be done.
</p>

<p>
    <?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button btn')); ?>
</p>

<div class="search-form" style="display:none">
    <?php
        $this->renderPartial('_search',
                             array('model' => $model,
                                  )
                            );
    ?>
</div><!-- search-form -->

<?php
    $this->widget('bootstrap.widgets.TbGridView',
                  array('id' => 'project-grid',
				  		'type' => array(TbHtml::GRID_TYPE_STRIPED,
				  						TbHtml::GRID_TYPE_BORDERED,
				  						TbHtml::GRID_TYPE_CONDENSED,
				  						TbHtml::GRID_TYPE_HOVER),
                        'dataProvider' => $model->search(),
                        'filter' => $model,
                        'columns' => array('id',
                                           'name',
                                           'description',
/*                                         'create_time',
                                           'create_user_id',
                                           'update_time',
                                           'update_user_id',
*/										   array('header' => 'Edit',
										   		 'class'=>'bootstrap.widgets.TbButtonColumn',
                                                ),
                                          ),
                       )
                 );
?>