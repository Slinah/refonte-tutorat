<?php

namespace App\Controller;

use App\Entity\PersonneCours;
use App\Entity\CourseSearch;
use App\Form\Search\CourseSearchType;
use App\Form\UpdateCoursesType;
use App\Repository\CoursRepository;
use App\Repository\MatiereRepository;
use App\Repository\PersonneCoursRepository;
use App\Repository\PromoRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\DuplicateKeyException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

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

        $courses = $repository->findCoursePagination($courseSearch);
        $courses = $paginator->paginate(
            $courses,
            $request->query->getInt('page', 1),
            3
        );

        $dateNow = new \DateTime('now');

        return $this->render('courses/index.html.twig', [
            "formCourseSearch"=> $formCourseSearch->createView(),
            "courses"=>$courses,
            "tuteur"=>$tuteur,
            "dateNow"=>$dateNow
        ]);
    }

    /**
     * @Route("/courses/registration-courses/{id}", name="registration_courses")
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_USER')", message="No access! Get out!")
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
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_USER')", message="No access! Get out!")
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
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_USER')", message="No access! Get out!")
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
}
