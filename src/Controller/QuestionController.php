<?php

namespace App\Controller;

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
     *
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
     *
     * @Route("/questions/create", name="create")
     * @IsGranted({"ROLE_ADMIN", "ROLE_USER"})
     *
     */

    public function createQuestion(Request $request) {

        //$this->denyAccessUnlessGranted("ROLE_USER");

        //if (!$this->isGranted("ROLE_USER")){
        //    throw $this->createAccesDeniedException("Raté");
        //}

        $question = new QuestionForum();
        $question->setAuthor($this->getUser());
        //récup l'user co
        //$connectedUser = $this->getUser();
        //associe la question à cet user
        //$question->setAuthor($connectedUser);
        $questionForm = $this -> createForm(QuestionType::class, $question);

        //cette fonction prend les données du formulaire soumis et les injecte dans notre entité $question
        $questionForm->handleRequest($request);

        if ($questionForm->isSubmitted() && $questionForm->isValid()) {
            $question-> setDateCreated(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em-> persist($question);
            $em->flush();

            $this->addFlash('success', 'Merci pour votre contribution !');

            return $this-> redirectToRoute("last_questions");
        }

        return $this-> render("question_forum/create.html.twig", ["questionForm"=> $questionForm->createView()]);
    }

    /**
     * @Route("/questions/recentes", name="last_questions")
     */
    public function lastQuestions() {
        $questionRepository = $this->getDoctrine()
            ->getRepository(QuestionForum::class);

        //$questions = $questionRepository->findAll();

        $questions_forums = $questionRepository->findBy([], ["dateCreated"=> "DESC"], 30);
        //$questions = $questionRepository->findQuestionsWithAuthor();



        return $this->render('question_forum/last_questions.html.twig', ["questions_forums" => $questions_forums]);
    }

    /**
     * @Route("/questions/details/{id}", name="detail_question")
     */
    public function detailQuestion($id) {
        $questionRepository = $this -> getDoctrine()->getRepository(QuestionForum::class);
        $question = $questionRepository->find($id);
        //dd($question);

        //si la question n'existe pas, on casse une erreur 404
        if (empty($question)) {
            throw $this -> createNotFoundException("Cette question n'existe pas ou plus");
        }

        $commentRepo = $this->getDoctrine()->getRepository(Comment::class);
        $comments = $commentRepo->findBy(["question"=> $question], ["dateCreated"=> "ASC"], 100);

        return $this-> render("question_forum/detail_question.html.twig", ["question"=> $question, "comments" => $comments]);
    }
}