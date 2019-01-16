<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "wishlist".
 *
 * @property int $id_wishlist
 * @property int $id_user
 * @property int $id_country
 */
class Wishlist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wishlist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_country'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_wishlist' => 'Id Wishlist',
            'id_user' => 'User',
            'id_country' => 'Country',
        ];
    }

    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id_user' => 'id']);
    }
    public function getCountries()
    {
        return $this->hasMany(Country::className(), ['id_country' => 'id_country']);
    }
}
