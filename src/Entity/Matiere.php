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
    private $validationAdmin = '1';

    public function __toString()
    {
        return $this->intitule;
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
