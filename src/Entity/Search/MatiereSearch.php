<?php

namespace App\Entity\Search;

use Doctrine\ORM\Mapping as ORM;

Class MatiereSearch {

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
     * @var int|null
     *
     * @ORM\Column(name="validationAdmin", type="integer")
     */
    private $validationAdmin;

    /**
     * @return string
     */
    public function getIdMatiere(): string
    {
        return $this->idMatiere;
    }

    /**
     * @param string $idMatiere
     */
    public function setIdMatiere(string $idMatiere): void
    {
        $this->idMatiere = $idMatiere;
    }

    /**
     * @return string
     */
    public function getIntitule(): string
    {
        return $this->intitule;
    }

    /**
     * @param string $intitule
     */
    public function setIntitule(string $intitule): void
    {
        $this->intitule = $intitule;
    }

    /**
     * @return int|null
     */
    public function getValidationAdmin(): ?int
    {
        return $this->validationAdmin;
    }

    /**
     * @param int|null $validationAdmin
     */
    public function setValidationAdmin(?int $validationAdmin)
    {
        $this->validationAdmin = $validationAdmin;
    }
}