<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "trip".
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
            [['startdate', 'enddate'], 'safe'],
            [['notes'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_trip' => 'Id Trip',
            'id_country' => 'Id Country',
            'id_user' => 'Id User',
            'startdate' => 'Startdate',
            'enddate' => 'Enddate',
            'notes' => 'Notes',
        ];
    }

    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id_country' => 'id_country']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id_user' => 'id']);
    }
}
