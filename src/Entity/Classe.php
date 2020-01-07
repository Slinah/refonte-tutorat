<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClasseRepository")
 */
class Classe
{
    /**
     * @ORM\Column(name="id_classe", type="string", length=40, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idClasse;

    /**
     * @ORM\Column(name="classe", type="text", length=65535, nullable=false)
     */
    private $classe;

    /**
     * @ORM\ManyToOne(targetEntity="Promo")
     * @ORM\JoinColumn(name="id_promo", referencedColumnName="id_promo")
     */
    private $idPromo;

    public function getIdClasse(): ?string
    {
        return $this->idClasse;
    }

    public function getClasse(): ?string
    {
        return $this->classe;
    }

    public function setClasse(string $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    public function getIdPromo(): ?Promo
    {
        return $this->idPromo;
    }

    public function setIdPromo(?Promo $idPromo): self
    {
        $this->idPromo = $idPromo;

        return $this;
    }


}
