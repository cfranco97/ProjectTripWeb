<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;

class Country extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'capital', 'population', 'cod', 'description', 'id_continent'], 'required'],
            [['description'], 'string'],
            [['id_continent'], 'integer'],
            [['name', 'capital'], 'string', 'max' => 60],
            [['population'], 'string', 'max' => 20],
            [['cod'], 'string', 'max' => 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_country' => 'Id Country',
            'name' => 'Name',
            'capital' => 'Capital',
            'population' => 'Population',
            'cod' => 'Cod',
            'description' => 'Description',
            'id_continent' => 'Id Continent',
        ];
    }

    public function getContinent()
    {
        return $this->hasOne(Continent::className(), ['id_continent' => 'id_continent']);
    }

    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id_country' => 'id_country']);
    }

    public static function getCountry($id_country)
    {
        $data = \app\models\Country::find()
            ->where(['id_continent' => $id_country])
            ->select(['id_country AS id', 'name'])->asArray()->all();

        return $data;
    }
}
