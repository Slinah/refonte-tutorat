<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SwiftmailerController extends AbstractController
{
    /**
     * @Route("/swiftmailer", name="swiftmailer")
     */
    public function sendEmail( \Swift_Mailer $mailer)
    {
        $receiver=$this->getUser()->getMail();
        $em = $this->getDoctrine()->getManager();
        $query = 'SELECT intitule, date, heure FROM cours c 
                       join personne_cours pc on c.id_cours = pc.id_cours 
                      join personne p on p.id_personne = pc.id_personne 
                      where p.mail = :mail order by c.dateCreation DESC LIMIT 1;';

        $statement = $em->getConnection()->prepare($query);
        $statement->bindValue('mail', $receiver);
        $statement->execute();

        $result = $statement->fetchAll();

        $message = (new \Swift_Message('Cours crée avec succès !'))
            ->setContentType("text/html")
            ->setFrom('scratchoverflow@gmail.com')
            ->setTo($receiver)     #Envoie à celui qui vient de crée le cours
            ->setBody(
                $this->renderView(

                    'swiftmailer/index.html.twig', array('result'=>$result)
                )
            )
        ;

        $mailer->send($message);
        $message = (new \Swift_Message('Un cours vient d être crée'))
            ->setContentType("text/html")
            ->setFrom('scratchoverflow@gmail.com')
            ->setTo(['cedric.menanteau@epsi.fr' => 'Cedric',            #Envoie à la boite mail admin
                     'priscillia.dezettre@ecoles-wis.net' => 'Priscillia'
            ])

            ->setBody(
                $this->renderView(
                    'swiftmailer/noticeCreationCours.html.twig', array('result'=>$result)
                )
            )
        ;
        $mailer->send($message);

        return  $this->redirectToRoute("logs");
    }
}
