<?php

declare(strict_types=1);

namespace App\Storage\Repository;

use App\Storage\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/** @template-extends ServiceEntityRepository<User> */
final class UserRepository extends ServiceEntityRepository implements UserLoaderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function loadUserByIdentifier(string $identifier): UserInterface|null
    {
        return $this->findOneBy([
            'email' => $identifier,
        ]);
    }
}
