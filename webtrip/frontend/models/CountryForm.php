<?php
namespace frontend\models;

use yii\base\Model;
use app\models\Country;
use app\models\Continent;

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


            ['country','exist'],

        ];
    }

}
