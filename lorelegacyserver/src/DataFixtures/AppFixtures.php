<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\User;
use App\Entity\Campaign;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher) {}

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword(
            $this->passwordHasher->hashPassword($user, "1234")
        );
        $user->setIsActive(true);
        $manager->persist($user);

        $user1 = new User();
        $user1->setUsername('gamemaster01');
        $user1->setRoles(['ROLE_USER']);
        $user1->setPassword(
            $this->passwordHasher->hashPassword($user, "1234")
        );
        $user1->setIsActive(true);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername('player1');
        $user2->setRoles(['ROLE_USER']);
        $user2->setPassword(
            $this->passwordHasher->hashPassword($user, "1234")
        );        $user2->setIsActive(true);
        $manager->persist($user2);

        $user3 = new User();
        $user3->setUsername('player2');
        $user3->setRoles(['ROLE_USER']);
        $user3->setPassword(
            $this->passwordHasher->hashPassword($user, "1234")
        );        $user3->setIsActive(false);
        $manager->persist($user3);

        $campaign = new Campaign();
        $campaign->setTitle('Epic Adventure');
        $campaign->setGamemaster($user1);
        $campaign->getPlayers()->add($user2);
        $campaign->getPlayers()->add($user3);
        $campaign->setCreatedAt(new \DateTimeImmutable());
        $campaign->setUpdatedAt(new \DateTimeImmutable());
        $manager->persist($campaign);

        $manager->flush();
    }
}
