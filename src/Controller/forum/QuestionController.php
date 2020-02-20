<?php

namespace App\Controller\forum;

use App\Entity\Comment;
use App\Entity\QuestionForum;
use App\Entity\Vote;
use App\Form\QuestionType;
use App\Entity\Personne;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class QuestionController extends AbstractController {

    /**
     * @Route("/questions/votes/{id}", name="add_vote")
     * @IsGranted({"ROLE_ADMIN", "ROLE_USER"})
     */

    public function addVote(QuestionForum $question, EntityManagerInterface $em) {
        //personne déjà voté ?
        $voteRepo = $this->getDoctrine()->getRepository(Vote::class);
        $foundVote=$voteRepo->findOneBy(["user"=>$this->getUser(), "question"=>$question]);
        if (!empty($foundVote)) {
            $this->addFlash("error", "Déjà voté !");
            return $this->redirectToRoute("detail_question", ["id"=>$question->getIdQuestion()]);
        }

        $vote = new Vote();
        $vote->setDateCreated(new \DateTime);
        $vote->setUser($this->getUser());

        $vote->setQuestion($question);

        $em->persist($vote);

        $question->setNbVote($question->getNbVote()+1);

        $em->flush();

        $this->addFlash("success", "Votre vote a bien été pris en compte");
        return $this->redirectToRoute("detail_question", ["id"=>$question->getIdQuestion()]);
    }

    /**
     * @Route("/questions/create", name="create")
     * @IsGranted({"ROLE_ADMIN", "ROLE_USER"})
     */
    public function createQuestion(Request $request) {
        $question = new QuestionForum();
        $question->setAuthor($this->getUser());
        $questionForm = $this -> createForm(QuestionType::class, $question);

        //cette fonction prend les données du formulaire soumis et les injecte dans notre entité $question
        $questionForm->handleRequest($request);

        if ($questionForm->isSubmitted() && $questionForm->isValid()) {
            date_default_timezone_set('Europe/Amsterdam');
            $question-> setDateCreated(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em-> persist($question);
            $em->flush();
            $this->addFlash('success', 'Merci pour votre contribution !');

            return $this-> redirectToRoute("last_questions");
        }

        return $this-> render("forum/question_forum/create.html.twig", ["questionForm"=> $questionForm->createView()]);
    }

    /**
     * @Route("/questions/recentes", name="last_questions")
     */
    public function lastQuestions() {
        $questionRepository = $this->getDoctrine()
            ->getRepository(QuestionForum::class);

        $questions_forums = $questionRepository->findBy([], ["dateCreated"=> "DESC"], 30);

        return $this->render('question_forum/last_questions.html.twig', ["questions_forums" => $questions_forums]);
    }

    /**
     * @Route("/questions/details/{id}", name="detail_question")
     */
    public function detailQuestion($id) {
        $questionRepository = $this -> getDoctrine()->getRepository(QuestionForum::class);
        $question = $questionRepository->find($id);

        //si la question n'existe pas, on casse une erreur 404
        if (empty($question)) {
            throw $this -> createNotFoundException("Cette question n'existe pas ou plus");
        }

        $commentRepo = $this->getDoctrine()->getRepository(Comment::class);
        $comments = $commentRepo->findBy(["question"=> $question], ["dateCreated"=> "DESC"], 100);

        return $this-> render("forum/question_forum/detail_question.html.twig", [
            "question"=> $question,
            "comments" => $comments
        ]);
    }
}