<?php

namespace App\Tests;

use App\Entity\Task;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{

    public function testCreateATaskDelete()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $user = $userRepository->findOneByEmail('user@user.com');

        $client->loginUser($user);

        $crawler = $client->request('GET', '/tasks/create');

        $form = $crawler->selectButton('Ajouter')->form();
        $form['task[title]'] = 'Test Create Task';
        $form['task[content]'] = 'Test Content';
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $taskRepository = static::$container->get(TaskRepository::class);

        $task = $taskRepository->findOneByTitle('Test Create Task');

        $client->request('GET', '/tasks/'  .  $task->getid() . '/delete');
        $client->followRedirect();

        $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testTaskEdition()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $user = $userRepository->findOneByUsername('admin');

        $client->loginUser($user);

        $crawler = $client->request('GET', '/tasks/161/edit');

        $form = $crawler->selectButton('Modifier')->form();
        $form['task[title]'] = 'update title';
        $form['task[content]'] = 'update content';
        $crawler = $client->submit($form);

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    public function testToggleActionSetIsDone()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $user = $userRepository->findOneByUsername('admin');
        $client->loginUser($user);
        $crawler = $client->request('GET', '/tasks/1/toggle');
        $this->assertResponseRedirects('/tasks');
        $crawler = $client->followRedirect();
        $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());
    }

    public function testDeletionOfATaskFromAnotherUser()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);

        $user = $userRepository->findOneByUsername('user');

        $client->loginUser($user);

        $admin = $userRepository->findOneByUsername('admin');

        $taskRepository = static::$container->get(TaskRepository::class);

        $task = $taskRepository->findOneByAuthor($admin);

        $crawler  = $client->request('GET', '/tasks/'  .  $task->getid() . '/delete');
        $crawler  = $client->followRedirect();
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
