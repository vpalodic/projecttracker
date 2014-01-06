<?php
    /* @var $this UserController */
    /* @var $model User */
    /* @var $form TbActiveForm */
?>

<div class="form">

    <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm',
                                   array('layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
                                         'id' => 'user-form',
                                         'enableAjaxValidation' => true,
                                         'enableClientValidation' => true,
                                         'clientOptions' => array('validateOnSubmit' => true,
                                                                 ),
                                        )
                                  );
    ?>

    <fieldset>
        <legend class="note">Fields with <span class="required">*</span> are required.</legend>

        <?php
            echo $form->errorSummary($model);
        ?>
        
        <?php
            echo $form->textFieldControlGroup($model,
                                              'username',
                                              array('span' => 6,
                                                    'maxlength' => 255
                                                   )
                                             );
        ?>

        <?php
            echo $form->emailFieldControlGroup($model,
                                               'email',
                                               array('span' => 6,
                                                     'maxlength' => 255
                                                    )
                                              );
        ?>

        <?php
            echo $form->passwordFieldControlGroup($model,
                                                  'password',
                                                  array('span' => 6,
                                                        'maxlength' => 255
                                                       )
                                                 );
        ?>

        <?php
            echo $form->passwordFieldControlGroup($model,
                                                  'password_repeat',
                                                  array('span' => 6,
                                                        'maxlength' => 255
                                                       )
                                                 );
        ?>
    </fieldset>

    <div class="form-actions">
        <?php
            echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',
                                      array('color' => TbHtml::BUTTON_COLOR_PRIMARY,
                                           )
                                     );
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->