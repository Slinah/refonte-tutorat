<?php

namespace App\Repository;

use App\Entity\Cours;
use App\Entity\Search\CourseSearch;
use App\Entity\Search\InternshipSearch;
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

    public function DeleteCoursesLinkToUser($id) {
        return $this->createQueryBuilder('q')
            ->delete()
            ->where("q.idPersonne = :idPersonne")
            ->setParameter("idPersonne", $id)

            ->join("PersonneCours", "pc")
            ->andWhere("pc.idCours = q.idCours")
        ;
    }

    public function findCoursePagination(CourseSearch $courseSearch) {
        $query = $this->createQueryBuilder('q')
            ->Where('q.stage = 0')
            ->andWhere('q.status = 0')
            ->OrderBy("q.date", "DESC");

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
            ->OrderBy("q.date", "DESC")
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
            ->OrderBy("q.date", "DESC");

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
            ->OrderBy("q.date", "DESC");

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
}
