<?php

namespace App\Repository;

use App\Entity\Speaker;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Contract\SpeakerRepository;

class SpeakerRepositoryDoctrine extends ServiceEntityRepository implements SpeakerRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Speaker::class);
    }

    public function findByEmail(string $email): Speaker | null
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function save(Speaker $speaker): void
    {
        $this->getEntityManager()->persist($speaker);
        $this->getEntityManager()->flush();
    }
}
