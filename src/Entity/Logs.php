<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="logs")
 * @ORM\Entity
 */
class Logs
{
    /**
     * @ORM\Column(name="id_log", type="string", length=40)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $idLog;

    /**
     * @ORM\Column(name="id_cours", type="string", length=40)
     */
    private $idCours;

    /**
     * @ORM\Column(name="heure", type="datetime")
     */
    private $heure;



    public function getIdLog(): ?string
    {
        return $this->idLog;
    }

    public function getIdCours(): ?string
    {
        return $this->idCours;
    }

    public function setIdCours(string $idCours)
    {
        $this->idCours = $idCours;


    }

    public function getHeure(): ?\DateTimeInterface
    {
        return $this->heure;
    }

    public function setHeure(\DateTimeInterface $heure): self
    {
        $this->heure = $heure;

        return $this;
    }


}
