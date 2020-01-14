<?php

namespace App\Repository;

use App\Entity\Cours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Cours|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cours|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cours[]    findAll()
 * @method Cours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cours::class);
    }

    public function findCourses()
    {
        return $this->createQueryBuilder('q')
            ->Where('q.stage = 0')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findInternship()
    {
        return $this->createQueryBuilder('q')
            ->Where('q.stage = 1')
            ->getQuery()
            ->getResult()
        ;
    }
}
