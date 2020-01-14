<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Form\GiveCoursesType;
use App\Form\UpdateCoursesType;
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
        $internship= $repo->findInternship();

        return $this->render('internship/index.html.twig', [
            "internship"=>$internship
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

    /**
     * @Route("/internship/update-internship/{id}", name="update_internship")
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

            return $this->redirectToRoute("courses");
        }

        return $this->render('internship/updateInternship.html.twig', [
            'form'=>$form->createView()
        ]);
    }
}
