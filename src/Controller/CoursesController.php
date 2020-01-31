<?php

namespace App\Controller;

use App\Entity\Search\CourseSearch;
use App\Form\CourseSearchType;
use App\Form\UpdateCoursesType;
use App\Repository\CoursRepository;
use App\Repository\MatiereRepository;
use App\Repository\PersonneCoursRepository;
use App\Repository\PromoRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

        //A voir pour faire une requête par semaine

        $courses = $repository->findCoursePagination($courseSearch);
        $courses = $paginator->paginate(
            $courses,
            $request->query->getInt('page', 1),
            3
        );

        $dateNow = new \DateTime('now');

        $LundisemaineCourante = new \DateTime();
        $DimanchesemaineCourante = new \DateTime();

        $LundisemaineSuivante = "2020-01-20";
        $DimanchesemaineSuivante = "2020-01-26";

        return $this->render('courses/index.html.twig', [
            "formCourseSearch"=> $formCourseSearch->createView(),
            "courses"=>$courses,
            "tuteur"=>$tuteur,
            "dateNow"=>$dateNow,
            "LundisemaineCourante"=>$LundisemaineCourante,
            "DimanchesemaineCourante"=>$DimanchesemaineCourante,
            "LundisemaineSuivante"=>$LundisemaineSuivante,
            "DimanchesemaineSuivante"=>$DimanchesemaineSuivante
        ]);
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
