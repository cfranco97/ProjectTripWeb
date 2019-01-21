<?php

namespace common\models;

use common\models\Country;
use common\models\User;
use Yii;

/**
 * This is the model class for table "review".
 *
 * @property int $id_trip
 * @property int $id_country
 * @property int $id_user
 * @property string $startdate
 * @property string $enddate
 * @property string $notes
 */
class Trip extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trip';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_country', 'id_user'], 'integer'],
            [['id_country', 'id_user'], 'required'],
            ['startdate', 'required'],
            ['startdate', 'safe'],
            ['startdate', 'date', 'format' => 'yyyy-M-d'],

            ['enddate', 'required'],
            ['enddate', 'safe'],
            ['enddate', 'date', 'format' => 'yyyy-M-d'],

            ['notes', 'required'],
            ['notes', 'string'],
            ['enddate', 'compare', 'compareAttribute' => 'startdate', 'operator' => '>'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_trip' => 'Id Trip',
            'id_country' => 'Country',
            'id_user' => 'User',
            'startdate' => 'Start date',
            'enddate' => 'End date',
            'notes' => 'Notes',
        ];
    }

    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id_country' => 'id_country']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_trip']);
    }

    public function getReview()
    {
        return $this->hasOne(Review::className(), ['id_review' => 'id_review']);
    }
}
