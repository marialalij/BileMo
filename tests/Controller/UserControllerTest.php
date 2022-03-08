<?php

namespace App\Tests;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UserControllerTest extends WebTestCase
{

    public function testCreateUser()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $user = $userRepository->findOneByUsername('admin');

        $client->loginUser($user);

        $crawler = $client->request('GET', '/users/create');

        $form = $crawler->selectButton('Ajouter')->form();
        $form['user[username]'] = 'jdzij';
        $form['user[password][first]'] = 'all';
        $form['user[password][second]'] = 'all';
        $form['user[email]'] = 'zhid@email.com';
        $crawler = $client->submit($form);
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }


    public function testUserEdition()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $user = $userRepository->findOneByUsername('admin');

        $client->loginUser($user);
        $crawler = $client->request('GET', '/users/6/edit');
        $form = $crawler->selectButton('Modifier')->form();
        $form['user[password][first]'] = 'newpassword';
        $form['user[password][second]'] = 'newpassword';
        $crawler = $client->submit($form);
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    public function testAllUsers()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $user = $userRepository->findOneByUsername('admin');
        $client->loginUser($user);
        $this->assertSelectorTextSame('h1', 'Liste des utilisateurs');
    }
}
