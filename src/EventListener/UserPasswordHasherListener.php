<?php

namespace App\EventListener;

use App\Entity\User;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserPasswordHasherListener
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        $this->handlePassword($args);
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        $this->handlePassword($args);
    }

    private function handlePassword(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        if (!$entity instanceof User) {
            return;
        }

        if ($entity->getPassword() !== null) {
            $encodedPassword = $this->passwordHasher->hashPassword(
                $entity,
                $entity->getPassword()
            );
            $entity->setPassword($encodedPassword);
        }
    }
}
