<?php

namespace App\DataFixtures;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @codeCoverageIgnore
 */

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }



    public function load(ObjectManager $manager)
    {

        $faker = \Faker\Factory::create('fr_FR');
        //Create user with ROLE_ADMIN
        $admin = new User();
        $plainPassword = 'password';
        $encodedPassword = $this->encoder->encodePassword($admin, $plainPassword);

        $admin->setUsername('admin');
        $admin->setEmail('admin@gmail.com');
        $admin->setPassword($encodedPassword);
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        //Create user with ROLE_USER
        $user = new User();
        $plainPassword = 'password';
        $encodedPassword = $this->encoder->encodePassword($user, $plainPassword);

        $user->setUsername('user');
        $user->setEmail('user@user.com');
        $user->setPassword($encodedPassword);
        $user->setRoles(['ROLE_USER']);

        $manager->persist($user);

        for ($i = 1; $i <= 10; ++$i) {
            $task = new Task();
            $task->setTitle('Todo ' . $i)
                ->setContent($faker->text(mt_rand(25, 200)));
            if ($i > 5) {
                $task->setIsDone(true);
            }
            $manager->persist($task);
        }

        $manager->flush();
    }
}
