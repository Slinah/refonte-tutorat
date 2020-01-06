<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MyProfilController extends AbstractController
{
    /**
     * @Route("/myProfil", name="my_profil")
     */
    public function index()
    {
        return $this->render('my_profil/index.html.twig');
    }
}
