<?php

namespace App\Repository;

use App\Entity\Talk;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Contract\TalkRepository;

class TalkRepositoryDoctrine extends ServiceEntityRepository implements TalkRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Talk::class);
    }

    public function save(Talk $talk): void
    {
        $this->getEntityManager()->persist($talk);
        $this->getEntityManager()->flush();
    }

    public function findById(int $id): Talk | null
    {
            return $this->createQueryBuilder('e')
                ->andWhere('e.id = :id')
                ->setParameter('id', $id)
                ->getQuery()
                ->getOneOrNullResult();
    }
}
