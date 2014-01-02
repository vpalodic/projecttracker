<?php
	/* @var $this IssueController */
	/* @var $model Issue */
?>

<?php
	$this->breadcrumbs = array('Projects' => array('project/index'),
							   $model->project->name => array('project/view',
							   						   'id' => $model->project_id
							   						  ),
							   'Issues' => array('index',
							   					 'pid' => $model->project_id
							   					),
							   'Manage',
							  );

	$this->menu = array(array('label' => 'List Project Issues',
							  'url' => array('index',
							   				 'pid' => $model->project_id
							   				)
							 ),
						array('label' => 'New Project Issue',
							  'url' => array('create',
							  				 'pid' => $model->project_id
							  				)
							 ),
						array('label' => 'Manage Project Issues',
							  'url' => array('admin',
							   				 'pid' => $model->project_id
							   				)
							  ),
					   );

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#issue-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2>Manage <?php echo CHtml::encode($model->project->name); ?> Issues</h2>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
        &lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php
	$this->widget('bootstrap.widgets.TbGridView',
				  array('id' => 'issue-grid',
				  		'type' => array(TbHtml::GRID_TYPE_STRIPED,
				  						TbHtml::GRID_TYPE_BORDERED,
				  						TbHtml::GRID_TYPE_CONDENSED,
				  						TbHtml::GRID_TYPE_HOVER),
				  		'dataProvider' => $model->search(),
				  		'filter' => $model,
				  		'columns' => array('id',
				  						   'name',
				  						   'description',
				  						   'type_id',
				  						   'status_id',
				  						   'owner_id',
				  						   'requester_id',
/*				  						   'create_time',
										   'create_user_id',
										   'update_time',
										   'update_user_id',
*/
										   array('header' => 'Edit',
										   		 'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>