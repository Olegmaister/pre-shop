<?php

namespace common\tests\unit\shop\Entities\Users;

use shop\Entities\Users\User;

/**
 * Login form test
 */
class SignupTest extends \Codeception\Test\Unit
{
    public function testSuccess()
    {
        //обращаемся к нашему методу
        //для создания пользователя
        $user = User::signup(
            $username = 'username',
            $email = 'username@gmail.com',
            $password = 'password'
        );

        $this->assertEquals($username, $user->username);//совпадение
        $this->assertEquals($email, $user->email);//совпадение
        $this->assertNotEmpty($user->password_hash);//не пустой
        $this->assertNotEquals($password, $user->password_hash);// не должно совпадать
        $this->assertNotEmpty($user->auth_key);//не пустой
        $this->assertTrue($user->isActive());// вернет true

    }
}
