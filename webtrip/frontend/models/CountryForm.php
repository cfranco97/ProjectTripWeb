<?php
namespace frontend\models;

use yii\base\Model;

class CountryForm extends Model
{
    public $continent;
    public $country;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['country', 'continent'],'required'],

            ['country','exist'],

        ];
    }

}
