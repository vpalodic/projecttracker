<?php
/* @var $this SysMessageController */
/* @var $model SysMessage */
?>

<?php
$this->breadcrumbs=array(
	'Sys Messages'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SysMessage', 'url'=>array('index')),
	array('label'=>'Create SysMessage', 'url'=>array('create')),
	array('label'=>'Update SysMessage', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SysMessage', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SysMessage', 'url'=>array('admin')),
);
?>

<h2>System Message #<?php echo CHtml::encode($model->id); ?> Details</h2>

<?php
	$this->widget('yiiwheels.widgets.detail.WhDetailView',
				  array('type' => array(TbHtml::GRID_TYPE_STRIPED,
				  						TbHtml::GRID_TYPE_BORDERED,
				  						TbHtml::GRID_TYPE_CONDENSED,
				  						TbHtml::GRID_TYPE_HOVER),
				  		'data' => $model,
				  		'attributes' => array('id',
				  							  'message',
				  							  array('name' => 'create_user_id',
				  							  		'value' => CHtml::encode($model->creatorText),
				  							  	   ),
				  							  'create_time',
				  							  array('name' => 'update_user_id',
				  							  		'value' => CHtml::encode($model->updaterText),
				  							  	   ),
				  							  'update_time',
	),
)); ?>