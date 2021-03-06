<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MailMatiereController extends AbstractController
{
    /**
     * @Route("/mail-matiere", name="mailmatiere")
     */
    public function sendEmail( \Swift_Mailer $mailer)
    {
        $receiver=$this->getUser()->getMail();
        $em = $this->getDoctrine()->getManager();

        $query = 'SELECT intitule from matiere m order by m.dateCreation DESC LIMIT 1;';

        $statement = $em->getConnection()->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();

        $message = (new \Swift_Message('Votre matière à bien été envoyé'))
            ->setContentType("text/html")
            ->setFrom('scratchoverflow@gmail.com')
            ->setTo($receiver)     #Envoie à celui qui vient de crée le cours
            ->setBody(
                $this->renderView(

                    'mail_matiere/index.html.twig', array('result'=>$result)
                )
            )
        ;

        $mailer->send($message);
        $message = (new \Swift_Message('Une matiere vient d etre suggéré'))
            ->setContentType("text/html")
            ->setFrom('tutorathep@gmail.com')
            ->setTo('tutorathep@gmail.com')          #Envoie à la boite mail admin
            ->setBody(
                $this->renderView(
                    'mail_matiere/noticeCreationMatiere.html.twig', array('result'=>$result)
                )
            )
        ;
        $mailer->send($message);

        return  $this->redirectToRoute("suggest_courses");
    }
}
