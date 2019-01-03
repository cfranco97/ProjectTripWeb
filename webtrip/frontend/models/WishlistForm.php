<?php
namespace frontend\models;

use common\models\Wishlist;
use yii\base\Model;

class WishlistForm extends Model
{
    public $id_user;
    public $id_country;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['id_user', 'required'],
            ['id_user', 'integer'],

            ['id_country', 'required'],
            ['id_country', 'integer'],
        ];
    }

    public function addWish()
    {
        if (!$this->validate()) {
            return null;
        }
        $whish = new Wishlist();
        $whish->id_user = $this->id_user;
        $whish->id_country = $this->id_country;
        return $whish->save() ? $whish : null;
    }

}