<?php

namespace App\Controller;

use App\Form\CancelCoursesType;
use App\Form\CloseCoursesType;
use App\Form\MatiereType;
use App\Form\UpdateCoursesType;
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
        $students=$personneRepo->findAll();

        $courses=$coursRepo->findCourses();
        $internship=$coursRepo->findInternship();

        $matieres=$matiereRepo->findAll();

        return $this->render('admin/index.html.twig', [
            "students"=>$students,
            "courses"=>$courses,
            "internship"=>$internship,
            "matieres"=>$matieres
        ]);
    }

    /**
     * @Route("/delete_student/{id}", name="delete_student")
     */
    public function deleteStudent(PersonneRepository $repo, $id)
    {
        $student = $repo->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($student);
        $em->flush();
        $this->addFlash('success', 'Elève supprimé avec succès !');

        return $this->redirectToRoute("admin");
    }

    /**
     * @Route("/close-course/{id}", name="close_course")
     */
    public function closeCourse(CoursRepository $repo, $id, Request $request)
    {
        $course = $repo->find($id);
        $course->setStatus(1);

        $form=$this->createForm(CloseCoursesType::class, $course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($course);
            $em->flush();
            $this->addFlash('success', 'Cours / stage clos avec succès !');

            return $this->redirectToRoute("admin");
        }

        return $this->render('admin/closeCourses.html.twig', [
            "course"=>$course,
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/cancel-course/{id}", name="cancel_course")
     */
    public function cancelCourse(CoursRepository $repo, $id, Request $request)
    {
        $course = $repo->find($id);
        $course->setStatus(2);

        $form=$this->createForm(CancelCoursesType::class, $course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($course);
            $em->flush();
            $this->addFlash('success', 'Cours / stage annulé avec succès !');

            return $this->redirectToRoute("admin");
        }

        return $this->render('admin/cancelCourses.html.twig', [
            "course"=>$course,
            "form"=>$form->createView()
        ]);
    }

    /**
     * @Route("/delete_course/{id}", name="delete_course")
     */
    public function deleteCourse(CoursRepository $repo, $id)
    {
        $course = $repo->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($course);
        $em->flush();
        $this->addFlash('success', 'Cours / stage supprimé avec succès !');

        return $this->redirectToRoute("admin");
    }

    /**
     * @Route("/update-matiere/{id}", name="update_matiere")
     */
    public function updateMatiere(MatiereRepository $repo, Request $request, $id)
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
    public function deleteMatiere(MatiereRepository $repo, $id)
    {
        $matiere = $repo->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($matiere);
        $em->flush();
        $this->addFlash('success', 'Matière supprimée avec succès !');

            return $this->redirectToRoute("admin");
    }
}
