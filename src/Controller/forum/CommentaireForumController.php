<?php

namespace App\Controller\forum;

use App\Entity\Comment;
use App\Entity\QuestionForum;
use App\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class CommentaireForumController extends AbstractController
{
    /**
     * @Route("/comment/creer/{id}", name="comment")
     * @IsGranted({"ROLE_ADMIN", "ROLE_USER"})
     */
    public function createComment(Request $request, $id){

        //récupère la question à laquelle est associé ce commentaire
        $questionRepo = $this-> getDoctrine()-> getRepository(QuestionForum::class);
        $question = $questionRepo-> find($id);

        $comment = new Comment();
        $commentForm = $this -> createForm(CommentType::class, $comment);

        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $comment-> setDateCreated(new \DateTime());
            //associe le nouveau commentaire à cette question !
            $comment->setQuestion($question);
            $comment->setCommentAuthor($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em-> persist($comment);
            $em->flush();

            $this->addFlash('success', 'Merci pour votre contribution !');

            //plus tard, rediriger vers la page de détails de la question
            return $this->redirectToRoute("detail_question", ["id" => $id]);
        }

        return $this->render('forum/commentaire_forum/comment.html.twig', ['commentForm' => $commentForm->createView()]);
    }
}
