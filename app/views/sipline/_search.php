<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SiplineSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sipline-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'line_name') ?>

    <?= $form->field($model, 'prefix') ?>

    <?= $form->field($model, 'minute_set') ?>

    <?= $form->field($model, 'minute_use') ?>

    <?= $form->field($model, 'error_set') ?>

    <?php // echo $form->field($model, 'error_use') ?>

    <?php // echo $form->field($model, 'time_try') ?>

    <?php // echo $form->field($model, 'time_success') ?>

    <?php // echo $form->field($model, 'call_limit_set') ?>

    <?php // echo $form->field($model, 'call_limit_use') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'comments') ?>

    <?php // echo $form->field($model, 'error_use_local') ?>

    <?php // echo $form->field($model, 'docker_contener') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
