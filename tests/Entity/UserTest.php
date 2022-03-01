<?php

namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserEntityTest extends TestCase
{
    public function testTrue()
    {
        $user = new User();

        $user->setUsername('username');
        $user->setPassword('password');
        $user->setEmail('test@email.com');
        $user->setRoles(['ROLE_USER']);

        $this->assertTrue($user->getUsername() === 'username');
        $this->assertTrue($user->getPassword() === 'password');
        $this->assertTrue($user->getEmail() === 'test@email.com');
        $this->assertTrue($user->getRoles() === ['ROLE_USER']);
    }

    public function testFalse()
    {
        $user = new User();

        $user->setUsername('username');
        $user->setPassword('password');
        $user->setEmail('email@test.com');
        $user->setRoles(['ROLE_USER']);
        $user->eraseCredentials();

        $this->assertFalse($user->getUsername() === 'false');
        $this->assertFalse($user->getPassword() === 'false');
        $this->assertFalse($user->getEmail() === 'false@email.com');
        $this->assertFalse($user->getRoles() === ['ROLE_FALSE']);
    }

    public function testEmpty()
    {


        $user = new User();

        $this->assertEmpty($user->getUsername());
        $this->assertEmpty($user->getPassword());
        $this->assertEmpty($user->getEmail());
        $this->assertEmpty($user->getId());
        $this->assertEmpty($user->getSalt());
        $this->assertEmpty($user->getUserIdentifier());
    }
}
