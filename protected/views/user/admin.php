<?php
    /* @var $this UserController */
    /* @var $model User */
?>

<?php
	$this->breadcrumbs = array('Users' => array('index'),
							   'Manage',
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

<h2>Manage Users</h2>

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
                  array('id' => 'user-grid',
				  		'type' => array(TbHtml::GRID_TYPE_STRIPED,
				  						TbHtml::GRID_TYPE_BORDERED,
				  						TbHtml::GRID_TYPE_CONDENSED,
				  						TbHtml::GRID_TYPE_HOVER),
                        'dataProvider' => $model->search(),
                        'filter' => $model,
                        'columns' => array('id',
                                           'username',
                                           'email',
                                           'last_login_time',
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