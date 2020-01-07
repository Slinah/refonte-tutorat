<?php

namespace App\Repository;

use App\Entity\PersonneTag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PersonneTag|null find($id, $lockMode = null, $lockVersion = null)
 * @method PersonneTag|null findOneBy(array $criteria, array $orderBy = null)
 * @method PersonneTag[]    findAll()
 * @method PersonneTag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonneTagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PersonneTag::class);
    }

    // /**
    //  * @return PersonneTag[] Returns an array of PersonneTag objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PersonneTag
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
