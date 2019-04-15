<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "unite".
 *
 * @property int $id
 * @property string $uniteID
 * @property string $server
 * @property int $setCountCallDay
 * @property int $useCountCallDay
 * @property int $setMinuteDay
 * @property int $useMinuteDay
 * @property int $setMinuteMonth
 * @property int $useMinuteMonth
 * @property int $setErrorDay
 * @property int $useErrorDay
 * @property string $stateLine
 * @property string $dateLastCall
 * @property string $dateLastSuccessCall
 * @property int $totalCall
 * @property int $totalSeconds
 * @property string $enable
 */
class Unite extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unite';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uniteID'], 'required'],
            [['id', 'setCountCallDay', 'useCountCallDay', 'setMinuteDay', 'useMinuteDay', 'setMinuteMonth', 'useMinuteMonth', 'setErrorDay', 'useErrorDay', 'totalCall', 'totalSeconds', 'uuid'], 'integer'],
            [['dateLastCall', 'dateLastSuccessCall'], 'safe'],
            [['uniteID', 'server', 'stateLine', 'enable'], 'string', 'max' => 45],
            [['useCountCallDay','useMinuteDay','useMinuteMonth','useErrorDay', 'totalCall', 'totalSeconds'],'default', 'value' => '0'],
            [['setCountCallDay'],'default', 'value' => '70'],
            [['setMinuteDay'],'default', 'value' => '55'],
            [['stateLine'],'default', 'value' => 'ALLOW'],
            [['enable'],'default', 'value' => 'no'],
            [['server'],'default', 'value' => '172.10.0.3'],
            [['setErrorDay'],'default', 'value' => '45'],
            [['setMinuteMonth'],'default', 'value' => '1555'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uniteID' => 'Unite ID',
            'server' => 'Server',
            'setCountCallDay' => 'Set Count Call Day',
            'useCountCallDay' => 'Use Count Call Day',
            'setMinuteDay' => 'Set Minute Day',
            'useMinuteDay' => 'Use Minute Day',
            'setMinuteMonth' => 'Set Minute Month',
            'useMinuteMonth' => 'Use Minute Month',
            'setErrorDay' => 'Set Error Day',
            'useErrorDay' => 'Use Error Day',
            'stateLine' => 'State Line',
            'dateLastCall' => 'Date Last Call',
            'dateLastSuccessCall' => 'Date Last Success Call',
            'totalCall' => 'Total Call',
            'totalSeconds' => 'Total Seconds',
            'enable' => 'Enable',
            'uuid' => 'UUID',
        ];
    }
}
