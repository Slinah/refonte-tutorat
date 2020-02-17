<?php

namespace App\Controller;

use App\Entity\Logs;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LogsController extends AbstractController
{
    /**
     * @Route("/logs", name="logs")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        $query = 'SELECT id_cours from cours c order by c.dateCreation DESC LIMIT 1;';
        $statement = $em->getConnection()->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();


        $logs=new Logs();
        $logs->setIdCours($result[0]["id_cours"]);
        $logs->setHeure(new \DateTime("now"));

        $em->persist($logs);
        $em->flush();


        return $this->redirectToRoute("courses");
    }
}
