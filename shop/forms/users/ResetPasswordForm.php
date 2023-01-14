<?php

namespace shop\Forms\Users;

use yii\base\InvalidArgumentException;
use yii\base\Model;
use Yii;
use shop\Entities\Users\User;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }
}
