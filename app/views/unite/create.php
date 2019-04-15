<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Unite */

$this->title = 'Create Unite';
$this->params['breadcrumbs'][] = ['label' => 'Unites', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unite-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
