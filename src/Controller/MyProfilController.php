<?php

namespace App\Controller;

use App\Entity\PersonneTag;
use App\Form\TagType;
use App\Repository\CoursRepository;
use App\Repository\PersonneCoursRepository;
use App\Repository\PersonneTagRepository;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class MyProfilController extends AbstractController
{
    /**
     * @Route("/myProfil", name="my_profil")
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_USER')", message="No access! Get out!")
     */
    public function index(PersonneCoursRepository $personneCoursRepo, CoursRepository $repository, PaginatorInterface $paginator, PersonneTagRepository $tagsRepos, Request $request)
    {
        //récup l'user connecter
        $connectedUser = $this->getUser();

        //Rubrique mes cours à venir
        $tuteur = $personneCoursRepo->findAll();

        $coursesFollow = $repository->findCoursesFolow($connectedUser);
        $coursesFollow = $paginator->paginate(
            $coursesFollow,
            $request->query->getInt('page', 1),
            3
        );

        //Rubrique mes tags
        $tags = $tagsRepos->findTag($connectedUser);

        return $this->render('my_profil/index.html.twig', [
            "coursesFollow"=> $coursesFollow,
            "tuteur"=>$tuteur,
            "tags"=>$tags
        ]);
    }

    /**
     * @Route("/create-tag", name="create_tag")
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_USER')", message="No access! Get out!")
     */
    public function createTag(Request $request)
    {
        $tag = new PersonneTag();
        $form=$this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $connectedUser = $this->getUser();
            $tag->setIdPersonne($connectedUser);

            $em = $this->getDoctrine()->getManager();
            $em-> persist($tag);
            $em->flush();
            $this->addFlash('success', 'Tag ajouté avec succès !');

            return $this->redirectToRoute("my_profil");
        }

        return $this->render('my_profil/createTag.html.twig', [
            "formAjout"=>$form->createView()
        ]);
    }

    /**
     * @Route("/delete-tag/{id}", name="delete_tag")
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_USER')", message="No access! Get out!")
     */
    public function deleteTag(PersonneTagRepository $repo, $id)
    {
        $connectedUser = $this->getUser();
        $repo->findOneTag($id, $connectedUser);

        $em = $this->getDoctrine()->getManager();
        $em->flush();
        $this->addFlash('success', 'Tag supprimé avec succès !');

        return $this->redirectToRoute("my_profil");
    }
}
