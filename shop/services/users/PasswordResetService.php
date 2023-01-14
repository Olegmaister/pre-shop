<?php

namespace shop\Services\Users;

use shop\Forms\Users\ResetPasswordForm;
use Yii;
use shop\Entities\Users\User;
use shop\Forms\Users\PasswordResetRequestForm;
use shop\Repositories\Users\UserRepository;

class PasswordResetService
{
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function request(PasswordResetRequestForm $form)
    {
        $user = $this->users->findByEmail($form->email);

        if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
        }

        $this->users->save($user);

        $result =  Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($form->email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();

        if(!$result){
            throw new \DomainException('Sanding error');
        }
    }

    public function checkToken(string $token)
    {
        if (empty($token) || !is_string($token)) {
            throw new \InvalidArgumentException('Password reset token cannot be blank.');
        }

        $user = $this->users->findByPasswordResetToken($token);

        return $user;
    }

    public function resetPassword(User $user,ResetPasswordForm $form)
    {
        $user->setPassword($form->password);
        $user->removePasswordResetToken();
        $user->generateAuthKey();

        $this->users->save($user);
    }
}