<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;

class DefaultControllerTest extends WebTestCase
{

    public function testDefaultPage()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $user = $userRepository->findOneByUsername('user');

        $client->loginUser($user);
        $crawler = $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
        $this->assertSame(1, $crawler->filter('html:contains("Bienvenue sur Todo List, l\'application vous permettant de gérer l\'ensemble de vos tâches sans effort !")')->count());
        $this->assertSelectorExists('a', 'Se déconnecter');
        $this->assertSelectorExists('a', 'Créer une nouvelle tâche');
    }
}
