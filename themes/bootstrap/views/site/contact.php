<?php
    /* @var $this SiteController */
    /* @var $model ContactForm */
    /* @var $form TbActiveForm */
    $this->pageTitle = Yii::app()->name . ' - Contact Us';
    $this->breadcrumbs = array('Contact');
?>

<h2>Contact Us</h2>

<?php if(Yii::app()->user->hasFlash('contact')) : ?>

<?php $this->widget('bootstrap.widgets.TbAlert',
                    array('alerts' => array('contact'),));
?>

<?php else: ?>

<p>
If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
</p>

<div class = "form">
    <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm',
                                   array('layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
                                         'id' => 'contact-form',
                                         'enableAjaxValidation' => true,
                                         'enableClientValidation' => true,
                                         'clientOptions' => array('validateOnSubmit' => true),
                                         'htmlOptions' => array('enctype' => 'multipart/form-data')
                                         ));
    ?>

    <fieldset>

        <legend>Fields with <span class="required">*</span> are required.</legend>

        <?php echo $form->errorSummary($model); ?>

        <?php
            echo $form->textFieldControlGroup($model,
                                              'name');
        ?>

        <?php
            echo $form->emailFieldControlGroup($model,
                                               'email');
        ?>

        <?php echo $form->textFieldControlGroup($model,
                                                'subject',
                                                array('maxlength'=>128));
        ?>

        <?php echo $form->textAreaControlGroup($model,
                                               'body',
                                               array('rows'=>6, 'class'=>'span5'));
        ?>

        <?php if(CCaptcha::checkRequirements()) : ?>
            <div class="controls">
                    <?php $this->widget('CCaptcha'); ?>
            </div>

            <?php echo $form->textFieldControlGroup($model,
                                                    'verifyCode');
            ?>

            <div class="control-group">
                <p class="hint">Please enter the letters as they are shown in the image above.
                <br/>Letters are not case-sensitive.</p>
            </div>
        <?php endif; ?>

    </fieldset>

    <?php
        echo TbHtml::formActions(array(TbHtml::submitButton('Submit',
                                                            array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
                                       ));
    ?>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<?php endif; ?>