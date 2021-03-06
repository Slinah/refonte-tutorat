<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class StatsController extends AbstractController
{
    /**
     * @Route("/stats/global", name="stats_global")
     * @IsGranted({"ROLE_ADMIN"})
     */
    public function global()
    {
        return $this->render('stats/global.html.twig');
    }

    /**
     * @Route("/stats/recap-b1", name="stats_b1")
     * @IsGranted({"ROLE_ADMIN"})
     */
    public function b1()
    {
        return $this->render('stats/recapB1.html.twig');
    }

    /**
     * @Route("/stats/recap-b2", name="stats_b2")
     * @IsGranted({"ROLE_ADMIN"})
     */
    public function b2()
    {
        return $this->render('stats/recapB2.html.twig');
    }

    /**
     * @Route("/stats/recap-b3", name="stats_b3")
     * @IsGranted({"ROLE_ADMIN"})
     */
    public function b3()
    {
        return $this->render('stats/recapB3.html.twig');
    }

    /**
     * @Route("/stats/recap-I1", name="stats_I1")
     * @IsGranted({"ROLE_ADMIN"})
     */
    public function I1()
    {
        return $this->render('stats/recapI1.html.twig');
    }

    /**
     * @Route("/stats/recap-I2", name="stats_I2")
     * @IsGranted({"ROLE_ADMIN"})
     */
    public function I2()
    {
        return $this->render('stats/recapI2.html.twig');
    }

    /**
     * @Route("/stats/recap-wis1", name="stats_wis1")
     * @IsGranted({"ROLE_ADMIN"})
     */
    public function wis1()
    {
        return $this->render('stats/recapWIS1.html.twig');
    }

    /**
     * @Route("/stats/recap-wis2", name="stats_wis2")
     * @IsGranted({"ROLE_ADMIN"})
     */
    public function wis2()
    {
        return $this->render('stats/recapWIS2.html.twig');
    }

    /**
     * @Route("/stats/recap-wis3", name="stats_wis3")
     * @IsGranted({"ROLE_ADMIN"})
     */
    public function wis3()
    {
        return $this->render('stats/recapWIS3.html.twig');
    }
}
