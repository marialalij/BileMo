<?php

namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * Load user fixtures to database.
     *
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; ++$i) {
            $user = new User();
            $user->setEmail('user' . $i . '@email.com')
                ->setUsername('user' . $i)
                ->setPassword($this->encoder->encodePassword($user, 'password'));

            $manager->persist($user);
        }


        $manager->flush();
    }
}
