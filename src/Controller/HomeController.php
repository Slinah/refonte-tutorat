<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/explanation", name="explanation")
     */
    public function explanation()
    {
        return $this->render('home/explanation.html.twig');
    }

    /**
     * @Route("/rgpd", name="rgpd")
     */
    public function rgpd()
    {
        return $this->render('registration/rgpd.html.twig');
    }
}
