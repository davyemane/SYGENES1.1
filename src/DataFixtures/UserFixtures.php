<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements FixtureGroupInterface
{

    public function __construct(
        private UserPasswordHasherInterface $hasher
    )
    {
        
    }
    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setUsername('davyEmane');
        $admin->setPassword($this->hasher->hashPassword($admin,'admin'));
        $admin->setRoles(['ROLE_ADMIN']);
        $admin2 = new User();
        $admin2 -> setUsername('Emane');
        $admin2->setPassword($this->hasher->hashPassword($admin2,'admin'));
        $admin2->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);
        $manager->persist($admin2);

        for ($i=0; $i < 6; $i++) { 
            $user = new User();
            $user ->setUsername("bile$i");
            $user->setPassword($this->hasher->hashPassword($user,'user'));
            $manager->persist($user);
        }
        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['user'];
    }
}
