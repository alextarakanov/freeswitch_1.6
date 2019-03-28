<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Sipline */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sipline-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'line_name')->textInput() ?>

    <?= $form->field($model, 'prefix')->textInput() ?>

    <?= $form->field($model, 'minute_set')->textInput() ?>

    <?= $form->field($model, 'minute_use')->textInput() ?>

    <?= $form->field($model, 'error_set')->textInput() ?>

    <?= $form->field($model, 'error_use')->textInput() ?>

    <?= $form->field($model, 'time_try')->textInput() ?>

    <?= $form->field($model, 'time_success')->textInput() ?>

    <?= $form->field($model, 'call_limit_set')->textInput() ?>

    <?= $form->field($model, 'call_limit_use')->textInput() ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comments')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'error_use_local')->textInput() ?>

    <?= $form->field($model, 'docker_contener')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
