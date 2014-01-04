<?php
	/* @var $this SiteController */

	$this->pageTitle = Yii::app()->name;
?>

<?php
	if(!Yii::app()->user->isGuest && isset(Yii::app()->user->lastLogin)) {
		$content = 'You last logged in on ' . Yii::app()->user->lastLogin;
	} else {
		$content = '';
	}

	$this->beginWidget('bootstrap.widgets.TbHeroUnit',
					   array('heading' => 'Welcome to ' . CHtml::encode(Yii::app()->name),
					   		 'content' => $content,
						 	)
					  );
?>

<?php
	$this->endWidget();
?>

