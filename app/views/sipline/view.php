<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Sipline */

$this->title = $model->line_name;
$this->params['breadcrumbs'][] = ['label' => 'Siplines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sipline-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->line_name], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->line_name], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'line_name',
            'prefix',
            'minute_set',
            'minute_use',
            'error_set',
            'error_use',
            'time_try',
            'time_success',
            'call_limit_set',
            'call_limit_use',
            'state',
            'comments',
            'error_use_local',
            'docker_contener',
        ],
    ]) ?>

</div>
