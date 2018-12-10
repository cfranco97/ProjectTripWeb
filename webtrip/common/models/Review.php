<?php

namespace common\models;

use common\models\Trip;
use Yii;

/**
 * This is the model class for table "review".
 *
 * @property int $id_review
 * @property double $rating
 * @property string $message
 * @property int $id_user
 * @property int $id_trip
 * @property int $id_country
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $averagerating;
    public static function tableName()
    {
        return 'review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rating'], 'required'],
            [['id_user', 'id_trip','id_country'], 'integer'],
            [['rating'], 'double'],
            [['message'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_review' => 'Id Review',
            'rating' => 'Rating',
            'message' => 'Message',
            'id_user' => 'Id User',
            'id_trip' => 'Id Trip',
            'id_country' => 'Id Country',
        ];
    }
    public function getTrip()
    {
        return $this->hasOne(Trip::className(), ['id_trip' => 'id_trip']);
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}
