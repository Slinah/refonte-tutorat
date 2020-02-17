<?php

namespace App\Controller;

use App\Repository\CoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CourExpireController extends AbstractController
{
    /**
     * @Route("/courexpirer", name="courexpirer")
     */
    public function sendEmail( \Swift_Mailer $mailer, CoursRepository $coursRepository)
    {

        $em = $this->getDoctrine()->getManager();

        $dateNow=new \DateTime();
        $date=date_format($dateNow, 'Y-m-d');

        $query = 'SELECT intitule, date, heure from cours c where c.date < :date;';


        $statement = $em->getConnection()->prepare($query);
        // Set parameters
        $statement->bindValue('date', $date);
        $statement->execute();


        $result = $statement->fetchAll();

//        $this->addFlash('succes','Email envoyé avec succes 1');


        $message = (new \Swift_Message('Des cours attendent detre supprimés'))
            ->setContentType("text/html")
            ->setFrom('tutorathep@gmail.com')
            ->setTo('tutorathep@gmail.com')          #Envoie à la boite mail admin
            ->setBody(
                $this->renderView(
                    'cour_expire/index.html.twig', array('result'=>$result)
                )
            )
        ;
        $mailer->send($message);



        return  $this->redirectToRoute("logs");


    }
}
