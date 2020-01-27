<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SwiftmailerController extends AbstractController
{
    /**
     * @Route("/swiftmailer", name="swiftmailer")
     */
    public function sendEmail($name, \Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('tutorathep@gmail.com')
            ->setTo('etiti14@gmail.com')
            ->setBody(
                $this->renderView(
                // templates/hello/email.txt.twig
                    'swiftmailer/index.txt.twig',
                    ['name' => $name]
                )
            )
        ;
        $mailer->send($message);

        return $this->render("courses");
    }
}
