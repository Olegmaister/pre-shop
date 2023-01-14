<?php

namespace shop\Services\Users;

use shop\Forms\Users\LoginForm;
use shop\Repositories\Users\UserRepository;

class AuthService
{
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function auth(LoginForm $form)
    {
        $user = $this->users->findByUsername($form->username);

        if (!$user->validatePassword($form->password)) {
            throw new \DomainException('Incorrect password.');
        }

        return $user;
    }
}