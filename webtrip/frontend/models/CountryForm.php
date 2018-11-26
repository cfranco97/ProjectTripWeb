<?php
namespace frontend\models;

use yii\base\Model;
use app\models\Country;
use app\models\Continent;

/**
 * Signup form
 */
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

            ['continent ', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['id_country', 'exist', 'targetClass' => 'app\models\Country', 'targetAttribute' => 'id_country', 'skipOnEmpty' => true],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->id_country = $this->id_country;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }
}
