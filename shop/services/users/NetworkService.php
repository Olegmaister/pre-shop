<?php

namespace shop\Services\Users;

use shop\Entities\Users\User;
use shop\Repositories\Users\UserRepository;

class NetworkService
{
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function auth($networkId, $networkName)
    {
        $user = $this->users->findByNetworkIdNetworkName($networkId, $networkName);
        if ($user) {
            return $user;
        }

        /** @var $user User */
        $user = User::networkSignup();
        $user->assignNetwork($networkId, $networkName);

        $this->users->save($user);

        return $user;

    }

    public function bind($user, $networkId, $networkName)
    {
        /** @var User $user */
        $user->assignNetwork($networkId, $networkName);
        $this->users->save($user);
    }
}