<?php

namespace App\Controller;

use App\Entity\Matiere;
use App\Entity\Proposition;
use App\Form\MatiereType;
use App\Form\SuggestCoursesType;
use App\Repository\PropositionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class SuggestCoursesController extends AbstractController
{
    /**
     * @Route("/suggestCourses", name="suggest_courses")
     * @IsGranted({"ROLE_ADMIN", "ROLE_USER"})
     */
    public function index(Request $request, PropositionRepository $repo)
    {
        //récup l'user connecter
        if (!empty($this->getUser())) {
            $connectedUser = $this->getUser();
        }

        // Afficher le tableau des propositions
        $suggestList = $repo->findAll();

        // Formulaire d'ajout de proposition
        $proposition = new Proposition();
        $formProposition=$this->createForm(SuggestCoursesType::class, $proposition);
        $formProposition->handleRequest($request);
        $proposition->setDateCreation(new \DateTime('now'));

        if ($formProposition->isSubmitted() && $formProposition->isValid()){


            //associe la proposition à l'user co
            $connectedUser->getIdProposition()->add($proposition);
            $proposition->setIdCreateur($connectedUser);

            $em = $this->getDoctrine()->getManager();
            $em-> persist($proposition);
            $em->flush();
            $this->addFlash('success', 'Suggestion ajoutée avec succès !');

            return $this->redirectToRoute("logs_prop");
        }
        // Fin formulaire ajout proposition

        // Formulaire ajout de matière
        $matiere = new Matiere();
        $formMatiere=$this->createForm(MatiereType::class, $matiere);
        $matiere->setDateCreation(new \DateTime("now"));
        $formMatiere->handleRequest($request);

        if ($formMatiere->isSubmitted() && $formMatiere->isValid()){
            $em = $this->getDoctrine()->getManager();

            $em-> persist($matiere);
            $em->flush();
            $this->addFlash('success', 'Matière ajoutée avec succès ! Attente de la validation par un Admin');

            return $this->redirectToRoute("mailmatiere");
        }
        // Fin formulaire ajout de matière

        return $this->render('suggest_courses/index.html.twig', [
            "suggestList"=>$suggestList,
            "formProposition"=>$formProposition->createView(),
            "formMatiere"=>$formMatiere->createView()
        ]);
    }

    /**
     * @Route("/vote/{id}", name="vote_suggest")
     * @IsGranted({"ROLE_ADMIN", "ROLE_USER"})
     */
    public function VoteSuggest(PropositionRepository $repo, $id)
    {
        //récup l'user connecter
        $connectedUser = $this->getUser();

        $suggest = $repo->find($id);
        //associe la proposition à l'user co
        $connectedUser->getIdProposition()->add($suggest);

        //si une personne à déjà voté
        if (!empty($connectedUser->getIdProposition()->add($suggest))) {
            $this->addFlash("error", "Déjà voté, bien essayé !");
            return $this->redirectToRoute("suggest_courses");
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($suggest);
        //rajouter 1 au vote
        $suggest->setNbVote($suggest->getNbVote()+1);

        $em->flush();
        $this->addFlash('success', 'Votre vote à bien été pris en compte !');

        return $this->redirectToRoute("suggest_courses");
    }

    /**
     * @Route("/delete-suggest/{id}", name="delete_suggest")
     * @IsGranted({"ROLE_ADMIN", "ROLE_USER"})
     */
    public function deleteSuggest(PropositionRepository $repo, $id)
    {
        $suggest = $repo->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($suggest);
        $em->flush();
        $this->addFlash('success', 'Proposition supprimée avec succès !');

        return $this->redirectToRoute("suggest_courses");
    }
}
