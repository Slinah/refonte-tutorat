<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="logs_proposition")
 * @ORM\Entity
 */
class LogsProposition
{
    /**
     * @ORM\Column(name="id_log", type="string", length=40)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $idLog;

    /**
     * @ORM\Column(name="id_proposition", type="string", length=40, nullable=true)
     */
    private $idProposition;

    /**
     * @ORM\Column(name="heure", type="datetime", nullable=true)
     */
    private $heure;

    public function getIdLog(): ?string
    {
        return $this->idLog;
    }

    public function getIdProposition(): ?string
    {
        return $this->idProposition;
    }

    public function setIdProposition(?string $idProposition): self
    {
        $this->idProposition = $idProposition;

        return $this;
    }

    public function getHeure(): ?\DateTimeInterface
    {
        return $this->heure;
    }

    public function setHeure(?\DateTimeInterface $heure): self
    {
        $this->heure = $heure;

        return $this;
    }


}
