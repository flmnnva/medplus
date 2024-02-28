<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form of `app\models\User`.
 */
class UserRegister extends User
{
    public $password_confirmation;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(
            parent::rules(),
            [
                ['password_confirmation', 'compare', 'compareAttribute' => 'password'],
            ]
        );
    }
}