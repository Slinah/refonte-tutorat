<?php

namespace App\Controller;

use App\Form\UpdateCoursesType;
use App\Repository\CoursRepository;
use App\Repository\MatiereRepository;
use App\Repository\PromoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

class CoursesController extends AbstractController
{
    /**
     * @Route("/courses", name="courses")
     */
    public function index(CoursRepository $repository, PromoRepository $repo)
    {
        $courses = $repository->findCourses();

        $dateNow = new \DateTime('now');

        $LundisemaineCourante = new \DateTime('now');
        $DimanchesemaineCourante = new \DateTime('now');

        $LundisemaineSuivante = "2020-01-13";
        $DimanchesemaineSuivante = "2020-01-19";

        return $this->render('courses/index.html.twig', [
            "courses"=>$courses,
            "dateNow"=>$dateNow,
            "LundisemaineCourante"=>$LundisemaineCourante,
            "DimanchesemaineCourante"=>$DimanchesemaineCourante,
            "LundisemaineSuivante"=>$LundisemaineCourante,
            "DimanchesemaineSuivante"=>$DimanchesemaineCourante
        ]);
    }

    /**
     * @Route("/courses/update-courses/{id}", name="update_courses")
     */
    public function updateCourses(CoursRepository $repo, Request $request, $id)
    {
        //chercher objet à modif
        $courses = $repo->find($id);

        //Création form
        $form=$this->createForm(UpdateCoursesType::class, $courses);

        //récup données POST
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($courses);
            $em->flush();
            $this->addFlash('success', 'Cours modifié avec succès !');

            return $this->redirectToRoute("admin");
        }

        return $this->render('courses/updateCourses.html.twig', [
            "courses"=>$courses,
            'form'=>$form->createView()
        ]);
    }
}
