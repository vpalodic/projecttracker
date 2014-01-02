<?php
    /* @var $this IssueController */
    /* @var $model Issue */
    /* @var $form TbActiveForm */
?>

<div class="form">

    <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm',
                                   array('layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
                                         'id' => 'issue-form',
                                         'enableAjaxValidation' => true,
                                         'enableClientValidation' => true,
                                         'clientOptions' => array('validateOnSubmit' => true),
                                        ));
    ?>

    <fieldset>
        <legend class="note">Fields with <span class="required">*</span> are required.</legend>

        <?php
            echo $form->errorSummary($model);
        ?>
        
        <?php
            echo $form->textFieldControlGroup($model,
                                              'name',
                                              array('span' => 5,
                                                    'maxlength' => 255
                                                   ));
        ?>

        <?php
            echo $form->textAreaControlGroup($model,
                                             'description',
                                             array('rows' => 6,
                                                   'span' => 5
                                                  ));
        ?>

        <?php
            echo $form->dropDownListControlGroup($model,
                                                 'type_id',
                                                 $model->typeOptions,
                                                 array('span' => 5
                                                      ));
        ?>

        <?php
            echo $form->dropDownListControlGroup($model,
                                                 'status_id',
                                                 $model->statusOptions,
                                                 array('span' => 5
                                                      ));
        ?>

        <?php
            echo $form->dropDownListControlGroup($model,
                                                 'owner_id',
                                                 $model->project->userOptions,
                                                 array('span' => 5
                                                      ));
        ?>

        <?php
            echo $form->dropDownListControlGroup($model,
                                                 'requester_id',
                                                 $model->project->userOptions,
                                                 array('span' => 5
                                                      ));
        ?>
    </fieldset>

    <div class="form-actions">
        <?php
            echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',
                                      array('color' => TbHtml::BUTTON_COLOR_PRIMARY,
                                           ));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->