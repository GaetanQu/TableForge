<?php

namespace App\State;

use App\Entity\User;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserPasswordStateProcessor implements ProcessorInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $passwordHasher
    ) {}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        if ($data instanceof User && $data->getPassword()) {
            $hashed = $this->passwordHasher->hashPassword($data, $data->getPassword());
            $data->setPassword($hashed);
        }

        $this->entityManager->persist($data);
        $this->entityManager->flush();

        return $data;
    }
}