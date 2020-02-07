<?php

namespace App\Repository;

use App\Entity\Matiere;
use App\Entity\Search\MatiereSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Matiere|null find($id, $lockMode = null, $lockVersion = null)
 * @method Matiere|null findOneBy(array $criteria, array $orderBy = null)
 * @method Matiere[]    findAll()
 * @method Matiere[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MatiereRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Matiere::class);
    }

    public function findMatiereAdmin(MatiereSearch $matiereAdminSearch)
    {
        $query = $this->createQueryBuilder('q')
            ->OrderBy("q.intitule", "ASC");

        if ($matiereAdminSearch->getValidationAdmin()) {
            $query = $query
                ->Where('q.validationAdmin = :validation')
                ->setParameter('validation', $matiereAdminSearch->getValidationAdmin());
        }

        return $query->getQuery()->getResult();
    }
}
