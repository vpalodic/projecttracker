<?php
    /* @var $this ProjectController */
    /* @var $model ProjectUserForm */
    /* @var $form TbActiveForm  */
?>

<?php
  $this->pageTitle = Yii::app()->name . ' - Add User';

	$this->breadcrumbs = array('Projects' => array('index'),
                             $model->project->name => array('view',
                                                            'id' => $model->project->id
                                                           ),
                             'Add User'
                            );

  $this->menu = array(array('label' => 'Projects',
                            'items' => array(array('label' => 'List Projects',
                                                   'url' => array('index')
                                                  ),
                                             array('label' => 'View Project',
                                                   'url' => '#',
                                                  ),
                                             array('label' => 'Create Project',
                                                   'url' => array('create')
                                                  ),
                                             array('label' => 'Update Project',
                                                   'url' => array('update',
                                                                  'id' => $model->project->id
                                                                 )
                                                  ),
                                             array('label' => 'Delete Project',
                                                   'url' => '#',
                                                   'disabled' => true
                                                  ),
                                             TbHtml::menuDivider(),
                                             array('label' => 'Manage Projects',
                                                   'url' => array('admin')
                                                  ),
                                            )
                           ),
                      array('label' => 'Project Issues',
                            'items' => array(array('label' => 'List Issues',
                                                   'url' => array('issue/index',
                                                                  'pid' => $model->project->id
                                                                 )
                                                  ),
                                             array('label' => 'View Issue',
                                                   'url' => '#',
                                                   'disabled' => true
                                                  ),
                                             array('label' => 'Update Issue',
                                                   'url' => '#',
                                                   'disabled' => true
                                                  ),
                                             array('label' => 'Create Issue',
                                                   'url' => array('issue/create',
                                                                  'pid' => $model->project->id
                                                                 )
                                                  ),
                                             array('label' => 'Delete Issue',
                                                   'url' => '#',
                                                   'disabled' => true
                                                  ),
                                            array('label' => 'Manage Issues',
                                                   'url' => array('issue/admin',
                                                                  'pid' => $model->project->id
                                                                 )
                                                  ),
                                            )
                           ),
                      array('label' => 'Project Users',
                            'items' => array(array('label' => 'Add Project User',
                                                   'url' => '#',
                                                   'active' => true
                                                  ),
                                            )
                           )
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
                                          array(//'name' => 'username',
                                                'source' => $model->usernameList,
                                                'model' => $model,
                                                'attribute' => 'username',
                                                'htmlOptions' => array('placeholder' => 'Type a username',
                                                                       'class' => 'span6',
                                                                      ),
                                               ),
                                          true
                                         );

            echo $form->customControlGroup($autocomplete,
                                           $model,
                                           'username',
                                           array('help' => 'Enter a valid username',
                                                )
                                          );
        ?>

        <?php
            echo $form->dropDownListControlGroup($model,
                                                 'role',
                                                 Project::getUserRoleOptions(),
                                                 array('span' => 6
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
