<?php

namespace App\Controller;

use App\Repository\CoursRepository;
use App\Repository\MatiereRepository;
use App\Repository\PromoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

class CoursesController extends AbstractController
{
    /**
     * @Route("/courses", name="courses")
     */
    public function index(CoursRepository $repository, PromoRepository $repo)
    {
        $cours = $repository->findAll();

        //$promo= $repo->find()
        //$dateNow = date('d/m/Y');

        return $this->render('courses/index.html.twig', [
            "cours"=>$cours,
            //"promo"=>$promo
            //"dateNow"=>$dateNow
        ]);
    }
}
