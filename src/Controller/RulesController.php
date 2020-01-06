<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RulesController extends AbstractController
{
    /**
     * @Route("/rules", name="rules")
     */
    public function index()
    {
        return $this->render('rules/index.html.twig');
    }
}
