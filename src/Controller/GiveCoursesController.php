<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GiveCoursesController extends AbstractController
{
    /**
     * @Route("/giveCourses", name="give_courses")
     */
    public function index()
    {
        return $this->render('give_courses/index.html.twig');
    }
}
