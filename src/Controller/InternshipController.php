<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Form\GiveCoursesType;
use App\Repository\CoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class InternshipController extends AbstractController
{
    /**
     * @Route("/internship", name="internship")
     */
    public function index(CoursRepository $repo)
    {
        $cours= $repo->findInternship();

        return $this->render('internship/index.html.twig', [
            "cours"=>$cours
        ]);
    }

    /**
     * @Route("/internship/add-internship", name="add_internship")
     */
    public function addIntership(Request $request)
    {
        $addInternship = new Cours();
        $form=$this->createForm(GiveCoursesType::class, $addInternship);
        $addInternship->setDuree(0);
        $addInternship->setSecu("secu");
        $addInternship->setStage(1);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em-> persist($addInternship);
            $em->flush();
            $this->addFlash('success', 'Stage ajouté avec succès !');

            return $this->redirectToRoute("internship");
        }

        return $this->render('internship/addInternship.html.twig', [
            'form'=>$form->createView()
        ]);
    }
}
