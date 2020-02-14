<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="matiere")
 * @ORM\Entity
 */
class Matiere
{
    /**
     * @ORM\Column(name="id_matiere", type="string", length=40)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $idMatiere;

    /**
     * @ORM\Column(name="intitule", type="text", length=65535)
     */
    private $intitule;

    /**
     * @ORM\Column(name="dateCreation", type="datetime", nullable=true)
     */
    private $dateCreation;

    /**
     * @ORM\Column(name="validationAdmin", type="integer")
     */
    private $validationAdmin = '1';

    public function __toString()
    {
        return $this->intitule;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getIdMatiere(): ?string
    {
        return $this->idMatiere;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getValidationAdmin(): ?int
    {
        return $this->validationAdmin;
    }

    public function setValidationAdmin(int $validationAdmin): self
    {
        $this->validationAdmin = $validationAdmin;

        return $this;
    }
}
