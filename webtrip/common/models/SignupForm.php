<?php
namespace common\models;

use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $id_country;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['id_country', 'exist', 'targetClass' => '\common\models\Country', 'targetAttribute' => 'id_country'],
            ['id_country','required']
        ];
    }
    public function attributeLabels()
    {
        return [
            'id_country' => 'Country'
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
        $user->save(false);
        //return $user->save() ? $user : null;
        $auth = \Yii::$app->authManager;
        $userRole = $auth->getRole('user');
        $auth->assign($userRole,$user->getId());
        return $user;
    }
}
