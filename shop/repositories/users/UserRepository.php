<?php

namespace shop\Repositories\Users;

use shop\Entities\Users\User;
use yii\db\ActiveQuery;

class UserRepository
{
    public function findByUsername(string $username): User
    {
        return $this->getBy(['username' => $username]);
    }

    public function findByEmail(string $email): User
    {
        return $this->getBy(['email' => $email]);
    }

    public function findByPasswordResetToken(string $token): User
    {
        return $this->getBy(['password_reset_token' => $token]);
    }

    public function findByNetworkIdNetworkName($networkId, $networkName)
    {
        return User::find()->joinWith(['networks' => function(ActiveQuery $q) use($networkId,$networkName){
            $q->where(['network_id' => $networkId]);
            $q->andWhere(['network_name' => $networkName]);
        }])->one();
    }

    public function save(User $user): void
    {
        if (!$user->save()) {
            throw new \DomainException('Saving error');
        }
    }

    private function getBy($condition): User
    {
        if (!$user = User::find()->where($condition)->andWhere(['status' => User::STATUS_ACTIVE])->one()) {
            throw new \DomainException('User not found.');
        }

        return $user;
    }
}