<?php

namespace App\Controller;

use App\Entity\PersonneTags;
use App\Form\TagsType;
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
        $tag = new PersonneTags();
        $formAjoutTag=$this->createForm(TagsType::class, $tag);
        $formAjoutTag->handleRequest($request);

        if ($formAjoutTag->isSubmitted() && $formAjoutTag->isValid()){
            //associe le tag à l'user co
            $connectedUser = $this->getUser();
            $tag->setIdPersonne($connectedUser);

            $em = $this->getDoctrine()->getManager();
            $em-> persist($tag);
            $em->flush();
            $this->addFlash('success', 'Tag ajouté avec succès !');

            return $this->redirectToRoute("my_profil");
        }

        return $this->render('tags/createTag.html.twig', [
            "formAjoutTag"=>$formAjoutTag->createView()
        ]);
    }

    /**
     * @Route("/update-tag", name="update_tag")
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_USER')", message="No access! Get out!")
     */
    public function updateTag()
    {
        return $this->render('tags/updateTag.html.twig');
    }
}
