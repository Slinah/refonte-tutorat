<?php

namespace App\Controller;

use App\Repository\CoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SwiftmailerController extends AbstractController
{
    /**
     * @Route("/swiftmailer", name="swiftmailer")
     */
    public function sendEmail( \Swift_Mailer $mailer, CoursRepository $coursRepository)
    {
        $receiver=$this->getUser()->getMail();

        $message = (new \Swift_Message('Cours crée avec succès !'))
            ->setFrom('tutorathep@gmail.com')
            ->setTo($receiver)     #Envoie à celui qui vient de crée le cours
            ->setBody(
                $this->renderView(
                    'swiftmailer/index.html.twig'
                )
            )
        ;
        $mailer->send($message);

        $message = (new \Swift_Message('Un cours vient d être crée'))
            ->setFrom('tutorathep@gmail.com')
            ->setTo('tutorathep@gmail.com')          #Envoie à la boite mail admin
            ->setBody(
                $this->renderView(
                    'swiftmailer/noticeCreationCours.html.twig'
                )
            )
        ;
        $mailer->send($message);

        return $this->redirectToRoute("courses");
    }
}
