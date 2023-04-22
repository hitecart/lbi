<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $encoder;
    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {

        $fake = Factory::create();
        for ($u = 0; $u < 3; $u++) {
            $user = new User();
            $passHash =  $this->encoder->hashPassword($user, 'mypassword');

            $user->setUsername($fake->username)
                ->setEmail($fake->email)
                ->setAdmin(false)
                ->setPassword($passHash);
            $manager->persist($user);
        }
        $manager->flush();
    }
}
