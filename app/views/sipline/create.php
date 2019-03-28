<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sipline */

$this->title = 'Create Sipline';
$this->params['breadcrumbs'][] = ['label' => 'Siplines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sipline-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
