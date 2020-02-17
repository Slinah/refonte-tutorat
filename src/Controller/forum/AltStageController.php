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

class AltStageController extends AbstractController
{
    /**
     * @Route("/forum/altstage/see", name="see_altstage")
     */
    public function seeQuestion(PaginatorInterface $paginator, Request $request)
    {
        $questionSearch = new QuestionForumSearch();
        $formQuestionsForumSearch = $this->createForm(QuestionsForumSearchType::class, $questionSearch);
        $formQuestionsForumSearch->handleRequest($request);

        $questionRepository = $this->getDoctrine()
            ->getRepository(QuestionForum::class);

        $questions_forums = $questionRepository->findQuestionsAltStage($questionSearch);
        $questions_forums = $paginator->paginate(
            $questions_forums,
            $request->query->getInt('page', 1),
            30
        );

        return $this->render('forum/altstage/see.html.twig', [
            "formQuestionsForumSearch"=>$formQuestionsForumSearch->createView(),
            "questions_forums" => $questions_forums
        ]);
    }

    /**
     * @Route("/forum/altstage/post", name="post_altstage")
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
            $question->setMatiere('AlternanceStage');

            $em = $this->getDoctrine()->getManager();
            $em-> persist($question);
            $em->flush();
            $this->addFlash('success', 'Merci pour votre contribution !');

            return $this-> redirectToRoute("see_altstage");
        }

        return $this-> render("forum/altstage/post.html.twig", ["questionForm"=> $questionForm->createView()]);
    }
}
