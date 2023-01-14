<?php

namespace shop\Services\Users;

use shop\Repositories\Users\UserRepository;
use Yii;
use shop\Entities\Users\User;
use shop\Forms\Users\SignupForm;

class SignupService
{
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function signup(SignupForm $form)
    {
        $user = User::signup(
            $form->username,
            $form->email,
            $form->password
        );

        $this->users->save($user);

        $result =  Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($user->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();

        if(!$result){
            throw new \DomainException('Sending error(signup new user).');
        }

        return $user;
    }
}
