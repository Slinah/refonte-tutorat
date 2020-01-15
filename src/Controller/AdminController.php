<?php

namespace App\Controller;

use App\Form\MatiereType;
use App\Form\UpdateMatiereType;
use App\Repository\CoursRepository;
use App\Repository\MatiereRepository;
use App\Repository\PersonneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(MatiereRepository $matiereRepo, PersonneRepository $personneRepo, CoursRepository $coursRepo ,Request $request)
    {
        $peoples=$personneRepo->findAll();


        $courses=$coursRepo->findCourses();
        $internship=$coursRepo->findInternship();

        $matieres=$matiereRepo->findAll();

        return $this->render('admin/index.html.twig', [
            "peoples"=>$peoples,
            "courses"=>$courses,
            "internship"=>$internship,
            "matieres"=>$matieres
        ]);
    }

    /**
     * @Route("/update-matiere/{id}", name="update_matiere")
     */
    public function updateMatierep(MatiereRepository $repo, Request $request, $id)
    {
        //chercher objet à modif
        $matiere = $repo->find($id);

        //Création form
        $form=$this->createForm(UpdateMatiereType::class, $matiere);

        //récup données POST
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($matiere);
            $em->flush();
            $this->addFlash('success', 'Matière modifiée avec succès !');

            return $this->redirectToRoute("admin");
        }

        return $this->render('admin/updateMatiere.html.twig', [
            "matiere"=>$matiere,
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/delete_matiere/{id}", name="delete_matiere")
     */
    public function deleteMatiere(MatiereRepository $repo, $id, Request $request)
    {
        $matiere = $repo->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($matiere);
        $em->flush();
        $this->addFlash('success', 'Matière supprimée avec succès !');

            return $this->redirectToRoute("admin");
    }
}
