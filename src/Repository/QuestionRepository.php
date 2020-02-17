<?php

namespace App\Repository;

use App\Entity\QuestionForum;
use App\Entity\QuestionForumSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method QuestionForum|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestionForum|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestionForum[]    findAll()
 * @method QuestionForum[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestionForum::class);
    }

    public function findQuestionsGeneral(QuestionForumSearch $questionSearch)
    {
        $query = $this->createQueryBuilder('q')
            ->where("q.matiere = 'General'")
            ->orderBy("q.dateCreated", "DESC");

        if ($questionSearch->getTitle()) {
            $query = $query
                ->andWhere('q.title LIKE :title')
                ->setParameter('title', '%'.$questionSearch->getTitle().'%');
        }

        return $query ->getQuery() ->getResult();
    }

    public function findQuestionsMath(QuestionForumSearch $questionSearch)
    {
        $query = $this->createQueryBuilder('q')
            ->where("q.matiere = 'Math'")
            ->orderBy("q.dateCreated", "DESC");

        if ($questionSearch->getTitle()) {
            $query = $query
                ->andWhere('q.title LIKE :title')
                ->setParameter('title', '%'.$questionSearch->getTitle().'%');
        }

        return $query ->getQuery() ->getResult();
    }

    public function findQuestionsLinux(QuestionForumSearch $questionSearch)
    {
        $query = $this->createQueryBuilder('q')
            ->where("q.matiere = 'Linux'")
            ->orderBy("q.dateCreated", "DESC");

        if ($questionSearch->getTitle()) {
            $query = $query
                ->andWhere('q.title LIKE :title')
                ->setParameter('title', '%'.$questionSearch->getTitle().'%');
        }

        return $query ->getQuery() ->getResult();
    }

    public function findQuestionsProgrammation(QuestionForumSearch $questionSearch)
    {
        $query = $this->createQueryBuilder('q')
            ->where("q.matiere = 'Programmation'")
            ->orderBy("q.dateCreated", "DESC");

        if ($questionSearch->getTitle()) {
            $query = $query
                ->andWhere('q.title LIKE :title')
                ->setParameter('title', '%'.$questionSearch->getTitle().'%');
        }

        return $query ->getQuery() ->getResult();
    }

    public function findQuestionsDesign(QuestionForumSearch $questionSearch)
    {
        $query = $this->createQueryBuilder('q')
            ->where("q.matiere = 'Design'")
            ->orderBy("q.dateCreated", "DESC");

        if ($questionSearch->getTitle()) {
            $query = $query
                ->andWhere('q.title LIKE :title')
                ->setParameter('title', '%'.$questionSearch->getTitle().'%');
        }

        return $query ->getQuery() ->getResult();
    }

    public function findQuestionsMarketing(QuestionForumSearch $questionSearch)
    {
        $query = $this->createQueryBuilder('q')
            ->where("q.matiere = 'Marketing'")
            ->orderBy("q.dateCreated", "DESC");

        if ($questionSearch->getTitle()) {
            $query = $query
                ->andWhere('q.title LIKE :title')
                ->setParameter('title', '%'.$questionSearch->getTitle().'%');
        }

        return $query ->getQuery() ->getResult();
    }

    public function findQuestionsReseaux(QuestionForumSearch $questionSearch)
    {
        $query = $this->createQueryBuilder('q')
            ->where("q.matiere = 'Reseaux'")
            ->orderBy("q.dateCreated", "DESC");

        if ($questionSearch->getTitle()) {
            $query = $query
                ->andWhere('q.title LIKE :title')
                ->setParameter('title', '%'.$questionSearch->getTitle().'%');
        }

        return $query ->getQuery() ->getResult();
    }

    public function findQuestionsAltStage(QuestionForumSearch $questionSearch)
    {
        $query = $this->createQueryBuilder('q')
            ->where("q.matiere = 'AltStage'")
            ->orderBy("q.dateCreated", "DESC");

        if ($questionSearch->getTitle()) {
            $query = $query
                ->andWhere('q.title LIKE :title')
                ->setParameter('title', '%'.$questionSearch->getTitle().'%');
        }

        return $query ->getQuery() ->getResult();
    }

    public function findQuestionsBoite(QuestionForumSearch $questionSearch)
    {
        $query = $this->createQueryBuilder('q')
            ->where("q.matiere = 'Boite'")
            ->orderBy("q.dateCreated", "DESC");

        if ($questionSearch->getTitle()) {
            $query = $query
                ->andWhere('q.title LIKE :title')
                ->setParameter('title', '%'.$questionSearch->getTitle().'%');
        }

        return $query ->getQuery() ->getResult();
    }

    public function findQuestionsAnglais(QuestionForumSearch $questionSearch)
    {
        $query = $this->createQueryBuilder('q')
            ->where("q.matiere = 'Anglais'")
            ->orderBy("q.dateCreated", "DESC");

        if ($questionSearch->getTitle()) {
            $query = $query
                ->andWhere('q.title LIKE :title')
                ->setParameter('title', '%'.$questionSearch->getTitle().'%');
        }

        return $query ->getQuery() ->getResult();
    }

    public function findQuestionsFrancais(QuestionForumSearch $questionSearch)
    {
        $query = $this->createQueryBuilder('q')
            ->where("q.matiere = 'Francais'")
            ->orderBy("q.dateCreated", "DESC");

        if ($questionSearch->getTitle()) {
            $query = $query
                ->andWhere('q.title LIKE :title')
                ->setParameter('title', '%'.$questionSearch->getTitle().'%');
        }

        return $query ->getQuery() ->getResult();
    }
}
