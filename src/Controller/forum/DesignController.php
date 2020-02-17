<?php

namespace App\Controller\forum;

use App\Entity\QuestionForumSearch;
use App\Form\Search\QuestionsForumSearchType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\QuestionForum;
use App\Form\QuestionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class DesignController extends AbstractController
{
    /**
     * @Route("/forum/design/see", name="see_design")
     */
    public function seeQuestion(PaginatorInterface $paginator, Request $request)
    {
        $questionSearch = new QuestionForumSearch();
        $formQuestionsForumSearch = $this->createForm(QuestionsForumSearchType::class, $questionSearch);
        $formQuestionsForumSearch->handleRequest($request);

        $questionRepository = $this->getDoctrine()
            ->getRepository(QuestionForum::class);

        $questions_forums = $questionRepository->findQuestionsDesign($questionSearch);
        $questions_forums = $paginator->paginate(
            $questions_forums,
            $request->query->getInt('page', 1),
            30
        );

        return $this->render('forum/design/see.html.twig', [
            "formQuestionsForumSearch"=>$formQuestionsForumSearch->createView(),
            "questions_forums" => $questions_forums
        ]);
    }

    /**
     * @Route("/forum/design/post", name="post_design")
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
            $question->setMatiere('Design');

            $em = $this->getDoctrine()->getManager();
            $em-> persist($question);
            $em->flush();
            $this->addFlash('success', 'Merci pour votre contribution !');

            return $this-> redirectToRoute("voir_design");
        }
        return $this-> render("forum/design/post.html.twig", ["questionForm"=> $questionForm->createView()]);
    }
}
