<?php

declare(strict_types=1);

namespace App\Storage\Repository;

use App\Storage\Entity\PersonGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @template-extends ServiceEntityRepository<PersonGroup>
 */
final class PersonGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PersonGroup::class);
    }
}