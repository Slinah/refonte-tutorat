<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Logs
 *
 * @ORM\Table(name="logs")
 * @ORM\Entity
 */
class Logs
{
    /**
     * @var string
     *
     * @ORM\Column(name="id_log", type="string", length=40, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLog;

    /**
     * @var string
     *
     * @ORM\Column(name="id_cours", type="string", length=40, nullable=false)
     */
    private $idCours;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure", type="datetime", nullable=false)
     */
    private $heure;


}
