<?php
    /* @var $this ProjectController */
    /* @var $model ProjectUserForm */
    /* @var $form TbActiveForm  */
?>

<?php
    $this->pageTitle = Yii::app()->name . ' - Add User';

	$this->breadcrumbs = array('Projects' => array('index'),
                               CHtml::encode($model->project->name) => array('view',
                                                                             'id' => $model->project->id
                                                                   ),
                               'Add User'
                              );

	$this->menu = array(array('label' => 'Back to ' . CHtml::encode($model->project->name),
							  'url' => array('view',
                                             'id' => $model->project->id
                                            )
							 ),
					   );
?>

<?php $this->widget('bootstrap.widgets.TbAlert'); ?>

<h2>Add User To <?php echo CHtml::encode($model->project->name); ?></h2>

<div class="form">
    <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm',
                                   array('layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
                                         'id' => 'adduser-form',
                                         'enableAjaxValidation' => false,
                                         'enableClientValidation' => true,
                                         'clientOptions' => array('validateOnSubmit' => true,
                                                                 ),
                                        )
                                  );
    ?>

    <fieldset>
        <legend class="note">Fields with <span class="required">*</span> are required.</legend>

    	<?php echo $form->errorSummary($model); ?>

        <?php
            $autocomplete = $this->widget('bootstrap.widgets.TbTypeAhead',
                                          array('name' => 'username',
                                                'source' => $model->usernameList,
                                                'model' => $model,
                                                'attribute' => 'username',
//                                                'options' => array('minLength' => '2',
//                                                                  ),
                                                'htmlOptions' => array('placeholder' => 'Type a username',
//                                                                       'style' => 'height:20px;',                                                                       
                                                                      ),
                                               ),
                                          true
                                         );

            echo $form->customControlGroup($autocomplete,
                                           $model,
                                           'username',
                                           array('help' => 'Enter a valid username',
                                                 'span' => 5
                                                )
                                          );
        ?>

        <?php
            echo $form->dropDownListControlGroup($model,
                                                 'role',
                                                 Project::getUserRoleOptions(),
                                                 array('span' => 5
                                                      )
                                                );
        ?>
    </fieldset>

    <?php
        echo TbHtml::formActions(array(TbHtml::submitButton('Add User',
                                                            array('color' => TbHtml::BUTTON_COLOR_PRIMARY,
                                                                 )
                                                           ),
                                      )
                                );
    ?>

	<?php $this->endWidget(); ?>

</div><!-- form -->
