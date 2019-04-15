<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UniteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="unite-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'uniteID') ?>

    <?= $form->field($model, 'server') ?>

    <?= $form->field($model, 'setCountCallDay') ?>

    <?= $form->field($model, 'useCountCallDay') ?>

    <?php // echo $form->field($model, 'setMinuteDay') ?>

    <?php // echo $form->field($model, 'useMinuteDay') ?>

    <?php // echo $form->field($model, 'setMinuteMonth') ?>

    <?php // echo $form->field($model, 'useMinuteMonth') ?>

    <?php // echo $form->field($model, 'setErrorDay') ?>

    <?php // echo $form->field($model, 'useErrorDay') ?>

    <?php // echo $form->field($model, 'stateLine') ?>

    <?php // echo $form->field($model, 'dateLastCall') ?>

    <?php // echo $form->field($model, 'dateLastSuccessCall') ?>

    <?php // echo $form->field($model, 'totalCall') ?>

    <?php // echo $form->field($model, 'totalSeconds') ?>

    <?php // echo $form->field($model, 'enable') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
