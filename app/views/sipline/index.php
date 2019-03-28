<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SiplineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Siplines';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sipline-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Sipline', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
