<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\User;
use App\Entity\Campaign;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword('1234');
        $manager->persist($user);

        $user1 = new User();
        $user1->setUsername('gamemaster01');
        $user1->setRoles(['ROLE_USER']);
        $user1->setPassword('1234');
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername('player1');
        $user2->setRoles(['ROLE_USER']);
        $user2->setPassword('1234');
        $manager->persist($user2);

        $user3 = new User();
        $user3->setUsername('player2');
        $user3->setRoles(['ROLE_USER']);
        $user3->setPassword('1234');
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
