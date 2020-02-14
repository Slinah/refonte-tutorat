<?php

namespace App\Repository;

use App\Entity\Cours;
use App\Entity\CourseSearch;
use App\Entity\InternshipSearch;
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

    public function findCoursePagination1(CourseSearch $courseSearch) {
        $query = $this->createQueryBuilder('q')
            ->Where('q.stage = 0')
            ->andWhere('q.status = 0')
            ->OrderBy("q.date", "ASC");

        if ($courseSearch->getDate()) {
            $query = $query
                ->andWhere('q.date = :date')
                ->setParameter('date', $courseSearch->getDate());
        }

        if ($courseSearch->getIntitule()) {
            $query = $query
                ->andWhere('q.intitule Like :intitule')
                ->setParameter('intitule', '%'.$courseSearch->getIntitule().'%');
        }

        if ($courseSearch->getIdMatiere()) {
            $query = $query
                ->andWhere('q.idMatiere = :matiere')
                ->setParameter('matiere', $courseSearch->getIdMatiere());
        }

        if ($courseSearch->getIdPromo()) {
            $query = $query
                ->andWhere('q.idPromo = :promo')
                ->setParameter('promo', $courseSearch->getIdPromo());
        }

        return $query->getQuery();
    }

    public function findCoursePagination2(CourseSearch $courseSearch) {
        $query = $this->createQueryBuilder('q')
            ->Where('q.stage = 0')
            ->andWhere('q.status = 0')
            ->OrderBy("q.date", "ASC");

        if ($courseSearch->getDate()) {
            $query = $query
                ->andWhere('q.date = :date')
                ->setParameter('date', $courseSearch->getDate());
        }

        if ($courseSearch->getIntitule()) {
            $query = $query
                ->andWhere('q.intitule Like :intitule')
                ->setParameter('intitule', '%'.$courseSearch->getIntitule().'%');
        }

        if ($courseSearch->getIdMatiere()) {
            $query = $query
                ->andWhere('q.idMatiere = :matiere')
                ->setParameter('matiere', $courseSearch->getIdMatiere());
        }

        if ($courseSearch->getIdPromo()) {
            $query = $query
                ->andWhere('q.idPromo = :promo')
                ->setParameter('promo', $courseSearch->getIdPromo());
        }

        return $query->getQuery();
    }

    public function findCoursePagination3(CourseSearch $courseSearch) {
        $query = $this->createQueryBuilder('q')
            ->Where('q.stage = 0')
            ->andWhere('q.status = 0')
            ->OrderBy("q.date", "ASC");

        if ($courseSearch->getDate()) {
            $query = $query
                ->andWhere('q.date = :date')
                ->setParameter('date', $courseSearch->getDate());
        }

        if ($courseSearch->getIntitule()) {
            $query = $query
                ->andWhere('q.intitule Like :intitule')
                ->setParameter('intitule', '%'.$courseSearch->getIntitule().'%');
        }

        if ($courseSearch->getIdMatiere()) {
            $query = $query
                ->andWhere('q.idMatiere = :matiere')
                ->setParameter('matiere', $courseSearch->getIdMatiere());
        }

        if ($courseSearch->getIdPromo()) {
            $query = $query
                ->andWhere('q.idPromo = :promo')
                ->setParameter('promo', $courseSearch->getIdPromo());
        }

        return $query->getQuery();
    }

    public function findInternshipPagination(CourseSearch $internshipSearch) {
        $query = $this->createQueryBuilder('q')
            ->Where('q.stage = 1')
            ->andWhere('q.status = 0')
            ->OrderBy("q.date", "ASC")
        ;

        if ($internshipSearch->getDate()) {
            $query = $query
                ->andWhere('q.date = :date')
                ->setParameter('date', $internshipSearch->getDate());
        }

        if ($internshipSearch->getIntitule()) {
            $query = $query
                ->andWhere('q.intitule Like :intitule')
                ->setParameter('intitule', '%'.$internshipSearch->getIntitule().'%');
        }

        if ($internshipSearch->getIdMatiere()) {
            $query = $query
                ->andWhere('q.idMatiere = :idMatiere')
                ->setParameter('idMatiere', $internshipSearch->getIdMatiere());
        }

        if ($internshipSearch->getIdPromo()) {
            $query = $query
                ->andWhere('q.idPromo.promo = :idPromo')
                ->setParameter('idPromo', $internshipSearch->getIdPromo());
        }

        return $query->getQuery();
    }

    public function findCourseAdmin(CourseSearch $courseSearch)
    {
        $query = $this->createQueryBuilder('q')
            ->Where('q.stage = 0')
            ->OrderBy("q.date", "ASC");

        if ($courseSearch->getStatus()) {
            $query = $query
                ->andWhere('q.status = :status')
                ->setParameter('status', $courseSearch->getStatus());
        }

        if ($courseSearch->getIdMatiere()) {
            $query = $query
                ->andWhere('q.idMatiere = :matiere')
                ->setParameter('matiere', $courseSearch->getIdMatiere());
        }

        return $query->getQuery()->getResult();
    }

    public function findInternshipAdmin(InternshipSearch $internshipSearch)
    {
         $query = $this->createQueryBuilder('q')
            ->Where('q.stage = 1')
            ->OrderBy("q.date", "ASC");

        if ($internshipSearch->getIdMatiere()) {
            $query = $query
                ->andWhere('q.idMatiere = :matiere')
                ->setParameter('matiere', $internshipSearch->getIdMatiere());
        }

        if ($internshipSearch->getStatus()) {
            $query = $query
                ->andWhere('q.status = :status')
                ->setParameter('status', $internshipSearch->getStatus());
        }

        return $query->getQuery()->getResult();
    }

    public function findCoursesFolow($connectedUser)
    {
        return $this->createQueryBuilder('q')
            ->Where('q.stage = 0')
            ->andWhere('q.status = 0')

            ->join('App\Entity\PersonneCours', 'pc')
            ->andWhere('q.idCours = pc.idCours')
            ->andWhere('pc.idPersonne = :idConnectedUser')
            ->setParameter('idConnectedUser', $connectedUser)

            ->OrderBy("q.date", "ASC")
            ->getQuery()
            ->getResult()
        ;

//        Autre façon possible
//        $entityManager = $this->getEntityManager();
//
//        $query = $entityManager->createQuery(
//            'SELECT c, pc
//            FROM App\Entity\Cours c
//            JOIN App\Entity\PersonneCours pc
//            WHERE c.stage = 0,
//            AND WHERE c.status = 0
//            AND WHERE pc.idPersonne = :idConnectedUser
//            ORDER BY c.dates DESC'
//        )->setParameter('idConnectedUser', $connectedUser);

//        return $query->getResult();
    }
}
