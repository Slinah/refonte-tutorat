<?php

namespace App\Controller;

use App\Entity\PersonneSearch;
use App\Entity\CourseSearch;
use App\Entity\InternshipSearch;
use App\Entity\MatiereSearch;
use App\Entity\PromoSearch;
use App\Form\CancelCoursesType;
use App\Form\CloseCoursesType;
use App\Form\PersonneSearchType;
use App\Form\Search\CourseAdminSearchType;
use App\Form\Search\InternshipAdminSearchType;
use App\Form\Search\MatiereAdminSearchType;
use App\Form\UpdateCoursesType;
use App\Form\UpdateMatiereType;
use App\Repository\CoursRepository;
use App\Repository\MatiereRepository;
use App\Repository\PersonneCoursRepository;
use App\Repository\PersonneRepository;
use App\Repository\PropositionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     * @IsGranted("ROLE_ADMIN", message="No access! Get out!")
     */
    public function index(PersonneCoursRepository $personneCoursRepo, MatiereRepository $matiereRepo, PersonneRepository $personneRepo, CoursRepository $coursRepo, Request $request, PaginatorInterface $paginator)
    {
        $studentAdminSearch = new PersonneSearch();
        $promoAdminSearch = new PromoSearch();

        $formStudentAdminSearch = $this->createForm(PersonneSearchType::class, $studentAdminSearch);
        $formStudentAdminSearch->handleRequest($request);

        $students = $personneRepo->findStudentAdmin($studentAdminSearch, $promoAdminSearch);
        $students = $paginator->paginate(
            $students,
            $request->query->getInt('page', 1),
            10
        );

        $tuteur = $personneCoursRepo->findAll();

        $courseAdminSearch = new CourseSearch();
        $formCourseAdminSearch = $this->createForm(CourseAdminSearchType::class, $courseAdminSearch);
        $formCourseAdminSearch->handleRequest($request);

        $courses = $coursRepo->findCourseAdmin($courseAdminSearch);
        $courses = $paginator->paginate(
            $courses,
            $request->query->getInt('page', 1),
            10
        );

        $internshipAdminSearch = new InternshipSearch();
        $formInternshipAdminSearch = $this->createForm(InternshipAdminSearchType::class, $internshipAdminSearch);
        $formInternshipAdminSearch->handleRequest($request);

        $internship = $coursRepo->findInternshipAdmin($internshipAdminSearch);
        $internship = $paginator->paginate(
            $internship,
            $request->query->getInt('page', 1),
            10
        );

        $matiereAdminSearch = new MatiereSearch();
        $formMatiereAdminSearch = $this->createForm(MatiereAdminSearchType::class, $matiereAdminSearch);
        $formMatiereAdminSearch->handleRequest($request);

        $matieres = $matiereRepo->findMatiereAdmin($matiereAdminSearch);
        $matieres = $paginator->paginate(
            $matieres,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/index.html.twig', [
            "students"=>$students,
            "formStudentAdminSearch"=> $formStudentAdminSearch->createView(),
            "formCourseAdminSearch"=> $formCourseAdminSearch->createView(),
            "formInternshipAdminSearch"=> $formInternshipAdminSearch->createView(),
            "formMatiereAdminSearch"=> $formMatiereAdminSearch->createView(),
            "courses"=>$courses,
            "tuteur"=>$tuteur,
            "internship"=>$internship,
            "matieres"=>$matieres
        ]);
    }

    /**
     * @Route("/promote-student/{id}", name="promote_student")
     * @IsGranted("ROLE_ADMIN", message="No access! Get out!")
     */
    public function PromoteStudent(PersonneRepository $repo, $id)
    {
        $student = $repo->find($id);
        $student->setRole(2);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        $this->addFlash('success', 'Elève promu avec succès !');

        return $this->redirectToRoute("admin");
    }

    /**
     * @Route("/demote-student/{id}", name="demote_student")
     * @IsGranted("ROLE_ADMIN", message="No access! Get out!")
     */
    public function DemoteStudent(PersonneRepository $repo, $id)
    {
        $student = $repo->find($id);
        $student->setRole(1);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        $this->addFlash('success', 'Elève retrogradé avec succès !');

        return $this->redirectToRoute("admin");
    }

    /**
     * @Route("/delete-student/{id}", name="delete_student")
     * @IsGranted("ROLE_ADMIN", message="No access! Get out!")
     */
    public function deleteStudent(PersonneRepository $repo, PersonneCoursRepository $personneCoursRepo, PropositionRepository $personneSuggestRepo, $id)
    {
        $student = $repo->find($id);
        $personneSuggestRepo->DeleteSuggestLinkToUser($id);
        $personneCoursRepo->DeleteAssociationLinkToUser($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($student);
        $em->flush();
        $this->addFlash('success', 'Elève supprimé avec succès !');

        return $this->redirectToRoute("admin");
    }

    /**
     * @Route("/internship/update-internship-admin/{id}", name="update_internship_admin")
     * @Security("is_granted('ROLE_ADMIN')", message="No access! Get out!")
     */
    public function updateIntershipAdmin(CoursRepository $repo, Request $request, $id)
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
            $this->addFlash('success', 'Stage modifié avec succès !');

            return $this->redirectToRoute("admin");
        }

        return $this->render('internship/updateInternship.html.twig', [
            "internship"=>$internship,
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/courses/update-courses-admin/{id}", name="update_courses_admin")
     * @Security("is_granted('ROLE_ADMIN')", message="No access! Get out!")
     */
    public function updateCoursesAdmin(CoursRepository $repo, Request $request, $id)
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

    /**
     * @Route("/close-course-admin/{id}", name="close_course_admin")
     * @Security("is_granted('ROLE_ADMIN')", message="No access! Get out!")
     */
    public function closeCourseAdmin(CoursRepository $repo, $id, Request $request)
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

        return $this->render('courses/closeCourses.html.twig', [
            "course"=>$course,
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/cancel-course-admin/{id}", name="cancel_course_admin")
     * @Security("is_granted('ROLE_ADMIN')", message="No access! Get out!")
     */
    public function cancelCourseAdmin(CoursRepository $repo, $id, Request $request)
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

        return $this->render('courses/cancelCourses.html.twig', [
            "course"=>$course,
            "form"=>$form->createView()
        ]);
    }

    /**
     * @Route("/delete_course/{id}", name="delete_course")
     * @IsGranted("ROLE_ADMIN", message="No access! Get out!")
     */
    public function deleteCourseAdmin(CoursRepository $repo, PersonneCoursRepository $personneCoursRepo, $id)
    {
        $course = $repo->find($id);
        $personneCoursRepo->DeleteAssociationWithCourses($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($course);
        $em->flush();
        $this->addFlash('success', 'Cours / stage supprimé avec succès !');

        return $this->redirectToRoute("admin");
    }

    /**
     * @Route("/update-matiere/{id}", name="update_matiere")
     * @IsGranted("ROLE_ADMIN", message="No access! Get out!")
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
     * @IsGranted("ROLE_ADMIN", message="No access! Get out!")
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
