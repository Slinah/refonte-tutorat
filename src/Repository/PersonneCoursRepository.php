<?php

namespace App\Repository;

use App\Entity\PersonneCours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PersonneCours|null find($id, $lockMode = null, $lockVersion = null)
 * @method PersonneCours|null findOneBy(array $criteria, array $orderBy = null)
 * @method PersonneCours[]    findAll()
 * @method PersonneCours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonneCoursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PersonneCours::class);
    }

    public function DeleteAssociationLinkToUser($id)
    {
        return $this->createQueryBuilder('q')
            ->delete()
            ->Where('q.idPersonne = :idPersonne')
            ->setParameter('idPersonne', $id)

            ->getQuery()
            ->getResult()
            ;
    }

    public function DeleteAssociationWithCourses($id)
    {
        return $this->createQueryBuilder('q')
            ->delete()
            ->Where('q.idCours = :idCours')
            ->setParameter('idCours', $id)

            ->getQuery()
            ->getResult()
        ;
    }

    public function unsubscribeAssociation($id, $connectedUser)
    {
        return $this->createQueryBuilder('q')
            ->delete()
            ->Where('q.idCours = :idCours')
            ->setParameter('idCours', $id)

            ->andWhere('q.idPersonne = :connectedUser')
            ->setParameter('connectedUser', $connectedUser)

            ->getQuery()
            ->getResult()
        ;
    }

    public function findAllTuteur()
    {
        return $this->createQueryBuilder('q')
            ->where('q.rangPersonne = 1')
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return PersonneCours[] Returns an array of PersonneCours objects
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
    public function findOneBySomeField($value): ?PersonneCours
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
