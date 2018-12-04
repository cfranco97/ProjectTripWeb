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


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
                [['rating'], 'required'],
                [['rating'], 'integer'],
                [['message'], 'string', 'max' => 200],

        ];
    }

    public function saveAjaxReview()
    {
        if (!$this->validate()) {
            return null;
        }
        $review = new Review();
        $review->rating = $this->rating;
        $review->message = $this->message;
        $review->id_trip = $this->id_trip;
        $review->id_user = $this->id_user;
        return $review->save() ? $review : null;
    }

}