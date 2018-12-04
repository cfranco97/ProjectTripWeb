<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "review".
 *
 * @property int $id_review
 * @property int $rating
 * @property string $message
 * @property int $id_user
 * @property int $id_trip
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
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
            [['rating', 'id_user', 'id_trip'], 'integer'],
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
        ];
    }
}
