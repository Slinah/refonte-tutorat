<?php

namespace App\Controller;

use App\Entity\Cours;
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
        $suggest = $repo->findAll();

        $GiveCourses = new Cours();
        $form=$this->createForm(GiveCoursesType::class, $GiveCourses);
        //$GiveCourses->setDuree(0);
        $GiveCourses->setSecu("secu");
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em-> persist($GiveCourses);
            $em->flush();
            $this->addFlash('success', 'Cours ajouté avec succès !');

            return $this->redirectToRoute("courses");
        }

        return $this->render('give_courses/index.html.twig', [
            "suggest"=>$suggest,
            'form'=>$form->createView()
        ]);
    }
}
