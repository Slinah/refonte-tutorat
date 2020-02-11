<?php

namespace App\Controller;

use App\Entity\Tags;
use App\Repository\CoursRepository;
use App\Repository\PersonneCoursRepository;
use App\Repository\PersonneRepository;
use App\Repository\TagsRepository;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class MyProfilController extends AbstractController
{
    /**
     * @Route("/myProfil", name="my_profil")
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_USER')", message="No access! Get out!")
     */
    public function index(PersonneCoursRepository $personneCoursRepo, CoursRepository $repository, PaginatorInterface $paginator, TagsRepository $tagsRepos, Request $request)
    {
        //récup l'user connecter
        $connectedUser = $this->getUser();

        //Rubrique mes cours à venir
        $tuteur = $personneCoursRepo->findAll();

        $coursesFollow = $repository->findCoursesFolow($connectedUser);
        $coursesFollow = $paginator->paginate(
            $coursesFollow,
            $request->query->getInt('page', 1),
            3
        );

        //Rubrique mes tags
        $tags = $tagsRepos->findAll();
//        $entity = new Tags();
//        $entity->setIntitule('Expert');
//        $entity->setIntitule("A l'aise");
//        $entity->setIntitule("A besoin d'aide");

        return $this->render('my_profil/index.html.twig', [
            "coursesFollow"=> $coursesFollow,
            "tuteur"=>$tuteur,
            "tags"=>$tags
        ]);
    }
}
