<?php

namespace App\Repository;

use App\Entity\LogsProposition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method LogsProposition|null find($id, $lockMode = null, $lockVersion = null)
 * @method LogsProposition|null findOneBy(array $criteria, array $orderBy = null)
 * @method LogsProposition[]    findAll()
 * @method LogsProposition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LogsPropositionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LogsProposition::class);
    }

    // /**
    //  * @return LogsProposition[] Returns an array of LogsProposition objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LogsProposition
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
