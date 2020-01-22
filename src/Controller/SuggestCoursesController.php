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

class SuggestCoursesController extends AbstractController
{
    /**
     * @Route("/suggestCourses", name="suggest_courses")
     */
    public function index(Request $request, PropositionRepository $repo)
    {
        $suggestList = $repo->findAll();

        $proposition = new Proposition();
        $formProposition=$this->createForm(SuggestCoursesType::class, $proposition);
        $proposition->setSecu("secu");
        $formProposition->handleRequest($request);

        if ($formProposition->isSubmitted() && $formProposition->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em-> persist($proposition);
            $em->flush();
            $this->addFlash('success', 'Suggestion ajoutée avec succès !');

            return $this->redirectToRoute("suggest_courses");
        }


        $matiere = new Matiere();
        $formMatiere=$this->createForm(MatiereType::class, $matiere);
        $formMatiere->handleRequest($request);

        if ($formMatiere->isSubmitted() && $formMatiere->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em-> persist($matiere);
            $em->flush();
            $this->addFlash('success', 'Matière ajoutée avec succès ! Attente de la validation par un Admin');

            return $this->redirectToRoute("suggest_courses");
        }

        return $this->render('suggest_courses/index.html.twig', [
            "suggestList"=>$suggestList,
            "formProposition"=>$formProposition->createView(),
            "formMatiere"=>$formMatiere->createView()
        ]);
    }

    /**
     * @Route("/delete-suggest/{id}", name="delete_suggest")
     */
    public function deleteStudent(PropositionRepository $repo, $id)
    {
        $suggest = $repo->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($suggest);
        $em->flush();
        $this->addFlash('success', 'Proposition supprimée avec succès !');

        return $this->redirectToRoute("suggest_courses");
    }
}
