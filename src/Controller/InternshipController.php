<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Entity\PersonneCours;
use App\Entity\CourseSearch;
use App\Form\Search\CourseSearchType;
use App\Form\GiveCoursesType;
use App\Form\UpdateCoursesType;
use App\Repository\CoursRepository;
use App\Repository\PersonneCoursRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class InternshipController extends AbstractController
{
    /**
     * @Route("/internship", name="internship")
     */
    public function index(CoursRepository $repo, PersonneCoursRepository $personneCoursRepo, PaginatorInterface $paginator, Request $request)
    {
        $internshipSearch = new CourseSearch();
        $formInternshipSearch = $this->createForm(CourseSearchType::class, $internshipSearch);
        $formInternshipSearch->handleRequest($request);

        $tuteur = $personneCoursRepo->findAll();

        $internship= $repo->findInternshipPagination($internshipSearch);
//        $internship = $paginator->paginate(
//            $internship,
//            $request->query->getInt('page', 1),
//            3
//        );

        date_default_timezone_set('Europe/Amsterdam');
        $dateDebutSemaine = new \DateTime();
        $dateFinSemaine = new \DateTime();
        $dateDebutSemaineProchaine = new \DateTime();
        $dateFinSemaineProchaine = new \DateTime();
        $dateDebutSemaine->modify('this week');
        $dateFinSemaine->modify('this week +6 days');
        $dateDebutSemaineProchaine->modify('this week +7 days');
        $dateFinSemaineProchaine->modify('this week +13 days');
        $dateNow = new \DateTime('now');

        return $this->render('internship/index.html.twig', [
            "formInternshipSearch"=> $formInternshipSearch->createView(),
            "internship"=>$internship,
            "tuteur"=>$tuteur,
            "dateNow"=>$dateNow,
            "dateDebutSemaine" => $dateDebutSemaine,
            "dateFinSemaine" => $dateFinSemaine,
            "dateDebutSemaineProchaine" => $dateDebutSemaineProchaine,
            "dateFinSemaineProchaine" => $dateFinSemaineProchaine
        ]);
    }

    /**
     * @Route("/internship/registration-internship/{id}", name="registration_internship")
     * @IsGranted({"ROLE_ADMIN", "ROLE_USER"})
     */
    public function RegistrationInternship(CoursRepository $repo, $id)
    {
        //récup l'user connecter
        $connectedUser = $this->getUser();

        $internship = $repo->find($id);

        try {
            $association = new PersonneCours();
            $association->setIdPersonne($connectedUser);
            $association->setIdCours($internship);

            $em = $this->getDoctrine()->getManager();
            $em->persist($association);
            $em->flush();
            $this->addFlash('success', 'Vous venez de vous inscrire à un cours !');
        } catch (\Exception $e){
            $this->addFlash("error", "Déjà inscrit, bien essayé !");
            return $this->redirectToRoute("internship");
        }

        return $this->redirectToRoute("internship");
    }

    /**
     * @Route("/internship/unsubscribe-internship/{id}", name="unsubscribe_internship")
     * @IsGranted({"ROLE_ADMIN", "ROLE_USER"})
     */
    public function UnsubscribeInternship(PersonneCoursRepository $personneCoursRepo, $id)
    {
        //récup l'user connecter
        $connectedUser = $this->getUser();

        $personneCoursRepo->unsubscribeAssociation($id, $connectedUser);

        $em = $this->getDoctrine()->getManager();
        $em->flush();
        $this->addFlash('success', 'Vous venez de vous désinscrire d\'un stage !');

        return $this->redirectToRoute("internship");
    }

    /**
     * @Route("/internship/add-internship", name="add_internship")
     * @IsGranted({"ROLE_ADMIN", "ROLE_USER"})
     */
    public function addIntership(Request $request)
    {
        //récup l'user connecter
        if (!empty($this->getUser())) {
            $connectedUser = $this->getUser();
        }

        $addInternship = new Cours();
        $form=$this->createForm(GiveCoursesType::class, $addInternship);
        $addInternship->setDateCreation(new \DateTime("now"));
        $addInternship->setStage(1);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $association = new PersonneCours();
            $association->setIdPersonne($connectedUser);
            $association->setRangPersonne(1);
            $association->setIdCours($addInternship);

            $em = $this->getDoctrine()->getManager();
            $em-> persist($addInternship);
            $em-> persist($association);

            $em->flush();
            $this->addFlash('success', 'Stage ajouté avec succès !');

            return $this->redirectToRoute("internship");
        }

        return $this->render('internship/addInternship.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/internship/update-internship/{id}", name="update_internship")
     * @IsGranted({"ROLE_ADMIN", "ROLE_USER"})
     */
    public function updateIntership(CoursRepository $repo, Request $request, $id)
    {
        //chercher objet à modif
        $internship = $repo->find($id);

        //Création form
        $form=$this->createForm(UpdateCoursesType::class, $internship);

        //récup données POST
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($internship);
            $em->flush();
            $this->addFlash('success', 'Stage modifié avec succès !');

            return $this->redirectToRoute("internship");
        }

        return $this->render('internship/updateInternship.html.twig', [
            "internship"=>$internship,
            'form'=>$form->createView()
        ]);
    }
}
