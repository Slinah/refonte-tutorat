<?php

namespace App\Repository;

use App\Entity\Cours;
use App\Entity\Search\CourseSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

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

    /**
     * @return Query
     */

    public function findCoursePagination(CourseSearch $courseSearch): Query {
        $query = $this->findCourses();

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
                ->andWhere('q.idMatiere = :idMatiere')
                ->setParameter('idMatiere', $courseSearch->getIdMatiere());
        }

        if ($courseSearch->getIdPromo()) {
            $query = $query
                ->andWhere('q.idPromo.promo = :idPromo')
                ->setParameter('idPromo', $courseSearch->getIdPromo());
        }

        return $query->getQuery();
    }

    public function findCourses() : QueryBuilder
    {
        return $this->createQueryBuilder('q')
            ->Where('q.stage = 0')
            ->OrderBy("q.date", "DESC")
            ;
    }




    public function findInternshipPagination(CourseSearch $internshipSearch): Query {
        $query = $this->findInternship();

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

    public function findInternship() : QueryBuilder
    {
        return $this->createQueryBuilder('q')
            ->Where('q.stage = 1')
            ->OrderBy("q.date", "DESC")
            ;
    }
}
