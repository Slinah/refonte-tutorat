<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class InternshipController extends AbstractController
{
    /**
     * @Route("/internship", name="internship")
     */
    public function index()
    {
        return $this->render('internship/index.html.twig');
    }
}
