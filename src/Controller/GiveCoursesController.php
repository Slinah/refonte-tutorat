<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Form\GiveCoursesType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GiveCoursesController extends AbstractController
{
    /**
     * @Route("/giveCourses", name="give_courses")
     */
    public function index(Request $request)
    {
        $id="2";

        $GiveCourses = new Cours();
        $form=$this->createForm(GiveCoursesType::class, $GiveCourses);
        $GiveCourses->setIdCours($id);
        $GiveCourses->setStatus(0);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em-> persist($GiveCourses);
            $em->flush();
            $this->addFlash('success', 'Cours ajouté avec succès !');

            //je m'en vais
            //return $this->redirectToRoute("home");
        }

        return $this->render('give_courses/index.html.twig', [
            'form'=>$form->createView(),
        ]);
    }
}
