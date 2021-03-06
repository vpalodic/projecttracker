<?php
    /* @var $this ProjectController */
    /* @var $model Project */
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
                                          'name',
                                          array('span' => 6,
                                                'maxlength' => 255
                                               )
                                         );
    ?>

    <?php
        echo $form->textAreaControlGroup($model,
                                         'description',
                                         array('rows' => 6,
                                               'span' => 6
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