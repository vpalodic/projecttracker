<?php
/* @var $this CommentController */
/* @var $model Comment */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm',
                                   array('layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
                                         'id' => 'comment-form',
                                         'enableAjaxValidation' => false,
                                         'enableClientValidation' => true,
                                         'clientOptions' => array('validateOnSubmit' => true,
                                                                 ),
                                        )
                                  );
	?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php
    	echo $form->errorSummary($model);
    ?>

	<?php
		echo $form->textAreaControlGroup(
			$model,
			'content',
			array(
				'rows' => 6,
				'span' => 6
			)
		);
	?>

	<div class="form-actions">
		<?php
			echo TbHtml::submitButton(
				$model->isNewRecord ?
					'Leave Comment' :
					'Update Comment',
				array(
					'color' => TbHtml::BUTTON_COLOR_PRIMARY,
				)
			);
		?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->