<?php

namespace App\Controller;

use App\Entity\PersonneTag;
use App\Form\TagType;
use App\Repository\PersonneTagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class TagsController extends AbstractController
{
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

        return $this->render('tags/createTag.html.twig', [
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
        $tag = $repo->findOneTag($id, $connectedUser);

        $em = $this->getDoctrine()->getManager();
        $em->flush();
        $this->addFlash('success', 'Tag supprimé avec succès !');

        return $this->redirectToRoute("my_profil");
    }
}
