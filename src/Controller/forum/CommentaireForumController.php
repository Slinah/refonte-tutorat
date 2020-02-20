<?php

namespace App\Controller\forum;

use App\Entity\Comment;
use App\Entity\QuestionForum;
use App\Form\CommentType;
use App\Repository\CommentRepository;
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

    /**
     * @Route("/questions/details/update-comment/{id}", name="update_comment")
     * @IsGranted({"ROLE_ADMIN", "ROLE_USER"})
     */
    public function updateComment(CommentRepository $repo, Request $request, $id)
    {
        //chercher objet à modif
        $comment = $repo->find($id);

        //Création form
        $form=$this->createForm(CommentType::class, $comment);

        //récup données POST
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            $this->addFlash('success', 'Commentaire modifié avec succès !');

            return $this->redirectToRoute("forum");
        }

        return $this->render('forum/commentaire_forum/update_comment.html.twig', [
            "comment"=>$comment,
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/questions/details/delete-comment/{id}", name="delete_comment")
     * @IsGranted({"ROLE_ADMIN", "ROLE_USER"})
     */
    public function deleteComment(CommentRepository $repo, $id)
    {
        //chercher objet à modif
        $comment = $repo->find($id);

        $em=$this->getDoctrine()->getManager();
        $em->remove($comment);
        $em->flush();
        $this->addFlash('success', 'Commentaire supprimé avec succès !');

        return $this->redirectToRoute("forum");
    }
}
