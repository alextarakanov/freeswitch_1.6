<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sipline */

$this->title = 'Update Sipline: ' . $model->line_name;
$this->params['breadcrumbs'][] = ['label' => 'Siplines', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->line_name, 'url' => ['view', 'id' => $model->line_name]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sipline-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
