<?php

namespace App\Controller\forum;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\QuestionForum;
use App\Form\QuestionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ReseauxController extends AbstractController
{
    /**
     * @Route("/forum/reseaux/see", name="see_reseaux")
     */
    public function seeQuestion()
    {
        $questionRepository = $this->getDoctrine()
            ->getRepository(QuestionForum::class);

        $questions_forums = $questionRepository->findBy([], ["dateCreated"=> "DESC"], 30);

        return $this->render('forum/reseaux/see.html.twig', ["questions_forums" => $questions_forums]);
    }

    /**
     * @Route("/forum/reseaux/post", name="post_reseaux")
     * @IsGranted({"ROLE_ADMIN", "ROLE_USER"})
     */
    public function addQuestion(Request $request)
    {
        $question = new QuestionForum();
        $question->setAuthor($this->getUser());
        $questionForm = $this -> createForm(QuestionType::class, $question);
        $questionForm->handleRequest($request);

        if ($questionForm->isSubmitted() && $questionForm->isValid()) {
            date_default_timezone_set('Europe/Amsterdam');
            $question-> setDateCreated(new \DateTime());
            $question->setMatiere('Reseaux');

            $em = $this->getDoctrine()->getManager();
            $em-> persist($question);
            $em->flush();
            $this->addFlash('success', 'Merci pour votre contribution !');

            return $this-> redirectToRoute("see_reseaux");
        }
        return $this-> render("forum/reseaux/post.html.twig", ["questionForm"=> $questionForm->createView()]);
    }
}
