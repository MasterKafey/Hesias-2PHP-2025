<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $userPasswordHasher
    )
    {
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user
            ->setEmail('jean.marius@dyosis.com')
            ->setRoles(['ROLE_USER'])
            ->setEnabled(true)
            ->setPassword($this->userPasswordHasher->hashPassword($user, 'password'));

        $this->addReference($user->getEmail(), $user);

        $manager->persist($user);
        $manager->flush();
    }
}
