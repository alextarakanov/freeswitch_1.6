<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sipline".
 *
 * @property int $line_name
 * @property int $prefix
 * @property int $minute_set
 * @property int $minute_use
 * @property int $error_set
 * @property int $error_use
 * @property string $time_try
 * @property string $time_success
 * @property int $call_limit_set
 * @property int $call_limit_use
 * @property string $state
 * @property string $comments
 * @property int $error_use_local
 * @property string $docker_contener
 */
class Sipline extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sipline';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['line_name', 'prefix'], 'required'],
            [['line_name', 'prefix', 'minute_set', 'minute_use', 'error_set', 'error_use', 'call_limit_set', 'call_limit_use', 'error_use_local'], 'integer'],
            [['time_try', 'time_success'], 'safe'],
            [['state'], 'string', 'max' => 45],
            [['comments'], 'string', 'max' => 145],
            [['docker_contener'], 'string', 'max' => 25],
            [['line_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'line_name' => 'Line Name',
            'prefix' => 'Prefix',
            'minute_set' => 'Minute Set',
            'minute_use' => 'Minute Use',
            'error_set' => 'Error Set',
            'error_use' => 'Error Use',
            'time_try' => 'Time Try',
            'time_success' => 'Time Success',
            'call_limit_set' => 'Call Limit Set',
            'call_limit_use' => 'Call Limit Use',
            'state' => 'State',
            'comments' => 'Comments',
            'error_use_local' => 'Error Use Local',
            'docker_contener' => 'Docker Contener',
        ];
    }
}
