<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="logs")
 * @ORM\Entity(repositoryClass="App\Repository\logsRepository")
 */
class Logs
{
    /**
     * @ORM\Column(name="id_log", type="string", length=40, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLog;

    /**
     * @ORM\Column(name="id_cours", type="string", length=40, nullable=false)
     */
    private $idCours;

    /**
     * @ORM\Column(name="heure", type="datetime", nullable=false)
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

    public function setIdCours(string $idCours): self
    {
        $this->idCours = $idCours;

        return $this;
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
