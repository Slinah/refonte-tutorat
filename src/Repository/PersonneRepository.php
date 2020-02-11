<?php

namespace App\Repository;

use App\Entity\Personne;
use App\Entity\PersonneSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Personne|null find($id, $lockMode = null, $lockVersion = null)
 * @method Personne|null findOneBy(array $criteria, array $orderBy = null)
 * @method Personne[]    findAll()
 * @method Personne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Personne::class);
    }

    public function findStudentAdmin(PersonneSearch $studentAdminSearch)
    {
        $query = $this->createQueryBuilder('q')
//            ->InnerJoin("Promo", "p")
            ->OrderBy("q.idClasse", "ASC")
        ;

        if ($studentAdminSearch->getRole()) {
            $query = $query
                ->andWhere('q.role = :role')
                ->setParameter('role', $studentAdminSearch->getRole());
        }

        if ($studentAdminSearch->getIdClasse()) {
            $query = $query
                ->andWhere('q.idClasse = :classe')
                ->setParameter('classe', $studentAdminSearch->getIdClasse());
        }

        return $query->getQuery()->getResult();
    }

    // /**
    //  * @return Personne[] Returns an array of Personne objects
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
    public function findOneBySomeField($value): ?Personne
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
