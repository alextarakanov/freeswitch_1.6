<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Unite */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="unite-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    <?//= $form->field($model, 'id')->textInput() ?>-->

    <?= $form->field($model, 'uniteID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'server')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'setCountCallDay')->textInput() ?>

    <?= $form->field($model, 'useCountCallDay')->textInput() ?>

    <?= $form->field($model, 'setMinuteDay')->textInput() ?>

    <?= $form->field($model, 'useMinuteDay')->textInput() ?>

    <?= $form->field($model, 'setMinuteMonth')->textInput() ?>

    <?= $form->field($model, 'useMinuteMonth')->textInput() ?>

    <?= $form->field($model, 'setErrorDay')->textInput() ?>

    <?= $form->field($model, 'useErrorDay')->textInput() ?>

    <?= $form->field($model, 'stateLine')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dateLastCall')->textInput() ?>

    <?= $form->field($model, 'dateLastSuccessCall')->textInput() ?>

    <?= $form->field($model, 'totalCall')->textInput() ?>

    <?= $form->field($model, 'totalSeconds')->textInput() ?>

    <?= $form->field($model, 'enable')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
