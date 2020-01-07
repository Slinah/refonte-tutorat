<?php

namespace App\Controller;

use App\Repository\CoursRepository;
use App\Repository\MatiereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CoursesController extends AbstractController
{
    /**
     * @Route("/courses", name="courses")
     */
    public function index(CoursRepository $repository)
    {
        $cours = $repository->findAll();


        return $this->render('courses/index.html.twig', [
            "cours"=>$cours
        ]);
    }
}
