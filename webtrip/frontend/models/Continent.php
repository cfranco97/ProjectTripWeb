<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "continent".
 *
 * @property int $id_continent
 * @property string $name
 */
class Continent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'continent';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_continent' => 'Id Continent',
            'name' => 'Name',
        ];
    }


    public function getCountries()
    {
        return $this->hasMany(Country::className(), ['id_continent' => 'id_continent']);
    }
}