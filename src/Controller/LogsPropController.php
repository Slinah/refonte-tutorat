<?php

namespace App\Controller;

use App\Entity\LogsProposition;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LogsPropController extends AbstractController
{
    /**
     * @Route("/logs/prop", name="logs_prop")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        $query = 'SELECT id_proposition from proposition p order by p.dateCreation DESC LIMIT 1;';
        $statement = $em->getConnection()->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();


        $logsProp=new LogsProposition();
        $logsProp->setIdProposition($result[0]["id_proposition"]);
        $logsProp->setHeure(new \DateTime("now"));

        $em->persist($logsProp);
        $em->flush();

        return $this->redirectToRoute("suggest_courses");

    }
}
