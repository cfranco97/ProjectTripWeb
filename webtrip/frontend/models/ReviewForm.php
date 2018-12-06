<?php
namespace frontend\models;

use app\models\Review;
use frontend\controllers\SiteController;
use yii\base\Model;
use yii\web\Controller;

class ReviewForm extends Model
{
    public $rating;
    public $message;
    public $id_trip;
    public $id_user;
    public $id_country;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
                [['rating'], 'double'],
                [['message'], 'string', 'max' => 200],

        ];
    }

    public function saveReview()
    {
        if (!$this->validate()) {
            return null;
        }
        $review = new Review();
        $review->rating = $this->rating;
        $review->message = $this->message;
        $review->id_trip = $this->id_trip;
        $review->id_user = $this->id_user;
        $review->id_country = $this->id_country;
        return $review->save() ? $review : null;
    }

}