<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Entity\PersonneCours;
use App\Form\GiveCoursesType;
use App\Repository\PropositionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GiveCoursesController extends AbstractController
{
    /**
     * @Route("/giveCourses", name="give_courses")
     */
    public function index(Request $request, PropositionRepository $repo)
    {
        //récup l'user connecter
        if (!empty($this->getUser())) {
            $connectedUser = $this->getUser();
        }

        $suggest = $repo->findAll();

        $GiveCourses = new Cours();
        $form=$this->createForm(GiveCoursesType::class, $GiveCourses);
        $GiveCourses->setDateCreation(new \DateTime("now"));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $association = new PersonneCours();
            $association->setIdPersonne($connectedUser);
            $association->setRangPersonne(1);
            $association->setIdCours($GiveCourses);

            $em = $this->getDoctrine()->getManager();

            $em-> persist($GiveCourses);
            $em-> persist($association);

            $em->flush();
            $this->addFlash('success', 'Cours ajouté avec succès !');


            return $this->redirectToRoute("courexpirer");
        }

        return $this->render('give_courses/index.html.twig', [
            "suggest"=>$suggest,
            'form'=>$form->createView()
        ]);
    }
}
