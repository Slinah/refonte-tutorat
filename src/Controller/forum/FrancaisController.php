<?php

namespace App\Controller\forum;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Comment;
use App\Entity\QuestionForum;
use App\Entity\Vote;
use App\Form\QuestionType;
use App\Entity\Personne;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FrancaisController extends AbstractController
{
    /**
     * @Route("/forum/francais/see", name="voir_francais")
     */
    public function seeQuestion()
    {
        $questionRepository = $this->getDoctrine()
            ->getRepository(QuestionForum::class);

        $questions_forums = $questionRepository->findBy([], ["dateCreated"=> "DESC"], 30);

        return $this->render('francais/see.html.twig', ["questions_forums" => $questions_forums]);

    }

    /**
     * @Route("/forum/francais/post", name="post_francais")
     */
    public function addQuestion(Request $request)
    {

        $question = new QuestionForum();
        $question->setAuthor($this->getUser());
        $questionForm = $this -> createForm(QuestionType::class, $question);

        //cette fonction prend les données du formulaire soumis et les injecte dans notre entité $question
        $questionForm->handleRequest($request);

        if ($questionForm->isSubmitted() && $questionForm->isValid()) {
            date_default_timezone_set('Europe/Amsterdam');
            $question-> setDateCreated(new \DateTime());
            $question->setMatiere('Francais');

            $em = $this->getDoctrine()->getManager();

            $em-> persist($question);
            $em->flush();

            $this->addFlash('success', 'Merci pour votre contribution !');

            return $this-> redirectToRoute("voir_francais");
        }

        return $this-> render("francais/post.html.twig", ["questionForm"=> $questionForm->createView()]);
    }
}
