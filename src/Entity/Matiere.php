<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matiere
 *
 * @ORM\Table(name="matiere")
 * @ORM\Entity
 */
class Matiere
{
    /**
     * @var string
     *
     * @ORM\Column(name="id_matiere", type="string", length=40, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $idMatiere;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule", type="text", length=65535, nullable=false)
     */
    private $intitule;

    /**
     * @var int
     *
     * @ORM\Column(name="validationAdmin", type="integer", nullable=false)
     */
    private $validationadmin;

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

    public function getValidationadmin(): ?int
    {
        return $this->validationadmin;
    }

    public function setValidationadmin(int $validationadmin): self
    {
        $this->validationadmin = $validationadmin;

        return $this;
    }


}
