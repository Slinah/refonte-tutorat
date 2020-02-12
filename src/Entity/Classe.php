<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Classe
 *
 * @ORM\Table(name="classe", indexes={@ORM\Index(name="Fk_Promo", columns={"id_promo"})})
 * @ORM\Entity
 */
class Classe
{
    /**
     * @var string
     *
     * @ORM\Column(name="id_classe", type="string", length=40, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $idClasse;

    /**
     * @var string
     *
     * @ORM\Column(name="classe", type="text", length=65535, nullable=false)
     */
    private $classe;

    /**
     * @var \Promo
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Promo")
     * @ORM\JoinColumn(name="id_promo", referencedColumnName="id_promo")
     *
     */
    private $idPromo;

    public function __toString()
    {
        return $this->classe;
    }

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

    public function getIdPromo()
    {
        return $this->idPromo;
    }

    /**
     * @param \Promo $idPromo
     */
    public function setIdPromo($idPromo)
    {
        $this->idPromo = $idPromo;
    }
}
