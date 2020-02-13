<?php

namespace App\Controller;

use App\Repository\CoursRepository;
use App\Repository\PersonneCoursRepository;
use App\Repository\PersonneTagRepository;
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
    public function index(PersonneCoursRepository $personneCoursRepo, CoursRepository $repository, PaginatorInterface $paginator, PersonneTagRepository $tagsRepos, Request $request)
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
        date_default_timezone_set('Europe/Amsterdam');
        $dateDebutSemaine = new \DateTime();
        $dateFinSemaine = new \DateTime();
        $dateDebutSemaineProchaine = new \DateTime();
        $dateFinSemaineProchaine = new \DateTime();
        $dateDebutSemaine->modify('this week');
        $dateFinSemaine->modify('this week +6 days');
        $dateDebutSemaineProchaine->modify('this week +7 days');
        $dateFinSemaineProchaine->modify('this week +13 days');


        //Rubrique mes tags
        $tags = $tagsRepos->findTag($connectedUser);

        return $this->render('my_profil/index.html.twig', [
            "coursesFollow"=> $coursesFollow,
            "tuteur"=>$tuteur,
            "tags"=>$tags,
            "dateDebutSemaine" => $dateDebutSemaine,
            "dateFinSemaine" => $dateFinSemaine,
            "dateDebutSemaineProchaine" => $dateDebutSemaineProchaine,
            "dateFinSemaineProchaine" => $dateFinSemaineProchaine

        ]);
    }
}
