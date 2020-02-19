<?php

namespace App\Controller;

use App\Entity\PersonneCours;
use App\Entity\CourseSearch;
use App\Form\CancelCoursesType;
use App\Form\CloseCoursesType;
use App\Form\Search\CourseSearchType;
use App\Form\UpdateCoursesType;
use App\Repository\CoursRepository;
use App\Repository\PersonneCoursRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\DuplicateKeyException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class CoursesController extends AbstractController
{
    /**
     * @Route("/courses", name="courses")
     */
    public function index(CoursRepository $repository, PersonneCoursRepository $personneCoursRepo, PaginatorInterface $paginator, Request $request)
    {
        $courseSearch = new CourseSearch();
        $formCourseSearch = $this->createForm(CourseSearchType::class, $courseSearch);
        $formCourseSearch->handleRequest($request);

        $tuteur = $personneCoursRepo->findAll();

        $courses = $repository->findCoursePagination1($courseSearch);
//        $courses = $paginator->paginate(
//            $courses,
//            $request->query->getInt('page', 1),
//            2
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

        return $this->render('courses/index.html.twig', [
            "formCourseSearch"=> $formCourseSearch->createView(),
            "courses"=>$courses,
            "tuteur"=>$tuteur,
            "dateDebutSemaine" => $dateDebutSemaine,
            "dateFinSemaine" => $dateFinSemaine,
            "dateDebutSemaineProchaine" => $dateDebutSemaineProchaine,
            "dateFinSemaineProchaine" => $dateFinSemaineProchaine
        ]);
    }

    /**
     * @Route("/courses/details/{id}", name="details_courses")
     */
    public function detailsCourses(CoursRepository $repo, PersonneCoursRepository $personneCoursRepo, $id)
    {
        $course = $repo->find($id);

        $tuteur = $personneCoursRepo->findAll();

        return $this->render('courses/detailsCourses.html.twig', [
            "course"=>$course,
            "tuteur"=>$tuteur,
        ]);
    }

    /**
     * @Route("/courses/registration-courses/{id}", name="registration_courses")
     * @IsGranted({"ROLE_ADMIN", "ROLE_USER"})
     */
    public function RegistrationCourses(CoursRepository $repo, $id)
    {
        //récup l'user connecter
        $connectedUser = $this->getUser();

        $course = $repo->find($id);

        try {
            $association = new PersonneCours();
            $association->setIdPersonne($connectedUser);
            $association->setIdCours($course);

            $em = $this->getDoctrine()->getManager();
            $em->persist($association);
            $em->flush();
            $this->addFlash('success', 'Vous venez de vous inscrire à un cours !');
        } catch (\Exception $e){
            $this->addFlash("error", "Déjà inscrit, bien essayé !");
            return $this->redirectToRoute("courses");
        }

        return $this->redirectToRoute("courses");
    }

    /**
     * @Route("/courses/unsubscribe-courses/{id}", name="unsubscribe_courses")
     * @IsGranted({"ROLE_ADMIN", "ROLE_USER"})
     */
    public function UnsubscribeCourses(PersonneCoursRepository $personneCoursRepo, $id)
    {
        //récup l'user connecter
        $connectedUser = $this->getUser();

        $personneCoursRepo->unsubscribeAssociation($id, $connectedUser);

        $em = $this->getDoctrine()->getManager();
        $em->flush();
        $this->addFlash('success', 'Vous venez de vous désinscrire d\'un cours !');

        return $this->redirectToRoute("courses");
    }

    /**
     * @Route("/courses/update-courses/{id}", name="update_courses")
     * @IsGranted({"ROLE_ADMIN", "ROLE_USER"})
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

            return $this->redirectToRoute("courses");
        }

        return $this->render('courses/updateCourses.html.twig', [
            "courses"=>$courses,
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/close-course/{id}", name="close_course")
     * @IsGranted({"ROLE_ADMIN", "ROLE_USER"})
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

            return $this->redirectToRoute("courses");
        }

        return $this->render('courses/closeCourses.html.twig', [
            "course"=>$course,
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/cancel-course/{id}", name="cancel_course")
     * @IsGranted({"ROLE_ADMIN", "ROLE_USER"})
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

            return $this->redirectToRoute("courses");
        }

        return $this->render('courses/cancelCourses.html.twig', [
            "course"=>$course,
            "form"=>$form->createView()
        ]);
    }
}
