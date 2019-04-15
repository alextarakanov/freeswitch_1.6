<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UniteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Unites';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unite-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Unite', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

//            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'uniteID',
            'server',
            [
                'label' => 'sCntD',
                'attribute' => 'setCountCallDay',
                'value' => 'setCountCallDay',
//                'headerOptions' => ['style' => 'max-width:30px'],
            ],
            [
                'label' => 'uCntD',
                'attribute' => 'useCountCallDay',
                'value' => 'useCountCallDay',
//                'headerOptions' => ['style' => 'max-width:30px'],
            ],
            [
                'label' => 'sMntD',
                'attribute' => 'setMinuteDay',
                'value' => 'setMinuteDay',
//                'headerOptions' => ['style' => 'max-width:25px'],
            ],
            [
                'label' => 'uMntD',
                'attribute' => 'useMinuteDay',
                'value' => 'useMinuteDay',
//                'headerOptions' => ['style' => 'max-width:25px'],
            ],
            [
                'label' => 'sMntM',
                'attribute' => 'setMinuteMonth',
                'value' => 'setMinuteMonth',
//                'headerOptions' => ['style' => 'max-width:25px'],
            ],
            [
                'label' => 'uMntM',
                'attribute' => 'useMinuteMonth',
                'value' => 'useMinuteMonth',
//                'headerOptions' => ['style' => 'max-width:25px'],
            ],
            [
                'label' => 'sErrD',
                'attribute' => 'setErrorDay',
                'value' => 'setErrorDay',
//                'headerOptions' => ['style' => 'max-width:25px'],
            ],
            [
                'label' => 'uErrD',
                'attribute' => 'useErrorDay',
                'value' => 'useErrorDay',
//                'headerOptions' => ['style' => 'max-width:25px'],
            ],
            [
                'label' => 'state',
                'attribute' => 'stateLine',
                'value' => 'stateLine',
//                'headerOptions' => ['style' => 'max-width:25px'],
            ],
            [
                'label' => 'Last Call',
                'attribute' => 'dateLastCall',
                'value' => 'dateLastCall',
                'format' =>  ['date', 'dd.MM HH:mm'],
                'contentOptions' => ['style' => 'width: 150px; max-width: 150px;'],
                'headerOptions' => ['style' => 'width: 150px; max-width: 150px;'],
//                'headerOptions' => ['style' => 'max-width:160px'],
            ],
            [
                'label' => 'Sccss Call',
                'attribute' => 'dateLastSuccessCall',
                'format' =>  ['date', 'dd.MM HH:mm'],
                'value' => 'dateLastSuccessCall',
                'contentOptions' => ['style' => 'width: 150px; max-width: 150px;'],
                'headerOptions' => ['style' => 'width: 150px; max-width: 150px;'],
            ],
            [
                'label' => 'totlC',
                'attribute' => 'totalCall',
                'value' => 'totalCall',
//                'headerOptions' => ['style' => 'max-width:25px'],
            ],
            [
                'label' => 'totlS',
                'attribute' => 'totalSeconds',
                'value' => 'totalSeconds',
//                'headerOptions' => ['style' => 'max-width:25px'],
            ],
            [
                'label' => 'en',
                'attribute' => 'enable',
                'value' => 'enable',
//                'headerOptions' => ['style' => 'max-width:25px'],
            ],
            [
                'label' => 'uuid',
                'attribute' => 'uuid',
                'value' => 'uuid',
//                'headerOptions' => ['style' => 'max-width:25px'],
            ],


            [
                'class' => 'yii\grid\ActionColumn',  'template' => '{view}',
                'header'=>'act',
                'headerOptions' => ['style' => 'max-width:25px'],
            ],
        ],
    ]); ?>


</div>
