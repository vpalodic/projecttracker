<?php
/* @var $this SysMessageController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Sys Messages',
);

$this->menu=array(
	array('label'=>'Create SysMessage','url'=>array('create')),
	array('label'=>'Manage SysMessage','url'=>array('admin')),
);
?>

<h1>Sys Messages</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>