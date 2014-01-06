<?php
    /* @var $this UserController */
    /* @var $model User */
    /* @var $form CActiveForm */
?>

<div class="wide form">

    <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm',
                                   array('action' => Yii::app()->createUrl($this->route),
                                         'method' => 'get',
                                        )
                                  );
    ?>

    <?php
        echo $form->textFieldControlGroup($model,
                                          'id',
                                          array('span' => 6,
                                               )
                                         );
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
        echo $form->textFieldControlGroup($model,
                                          'last_login_time',
                                          array('span' => 6,
                                               )
                                         );
    ?>

    <?php
        echo $form->textFieldControlGroup($model,
                                          'create_time',
                                          array('span' => 6,
                                               )
                                         );
    ?>

    <?php
        echo $form->textFieldControlGroup($model,
                                          'create_user_id',
                                          array('span' => 6,
                                               )
                                         );
    ?>

    <?php
        echo $form->textFieldControlGroup($model,
                                          'update_time',
                                          array('span' => 6,
                                               )
                                         );
    ?>

    <?php
        echo $form->textFieldControlGroup($model,
                                          'update_user_id',
                                          array('span' => 6,
                                               )
                                         );
    ?>

    <div class="form-actions">
        <?php
            echo TbHtml::submitButton('Search',
                                      array('color' => TbHtml::BUTTON_COLOR_PRIMARY,
                                           )
                                     );
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->