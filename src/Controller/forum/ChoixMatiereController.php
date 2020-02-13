<?php

namespace App\Controller\forum;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ChoixMatiereController extends AbstractController
{
    /**
     * @Route("/forum", name="forum")
     */
    public function index()
    {
        return $this->render('choix_matiere/index.html.twig', [
            'controller_name' => 'ChoixMatiereController',
        ]);
    }
}
