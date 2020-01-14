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
        $cours = $repository->findCourses();

        $dateNow = new \DateTime('now');

        $LundisemaineCourante = new \DateTime('now');
        $DimanchesemaineCourante = new \DateTime('now');

        $LundisemaineSuivante = "2020-01-13";
        $DimanchesemaineSuivante = "2020-01-19";

        return $this->render('courses/index.html.twig', [
            "cours"=>$cours,
            "dateNow"=>$dateNow,
            "LundisemaineCourante"=>$LundisemaineCourante,
            "DimanchesemaineCourante"=>$DimanchesemaineCourante,
            "LundisemaineSuivante"=>$LundisemaineCourante,
            "DimanchesemaineSuivante"=>$DimanchesemaineCourante
        ]);
    }
}
