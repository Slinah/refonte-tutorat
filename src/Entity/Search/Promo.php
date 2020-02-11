<?php

namespace App\Entity\Search;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Promo
 *
 * @ORM\Table(name="promo", indexes={@ORM\Index(name="Fk_Ecole", columns={"id_ecole"})})
 * @ORM\Entity
 */
class Promo
{
    /**
     * @var string
     *
     * @ORM\Column(name="id_promo", type="string", length=40, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $idPromo;

    /**
     * @var string
     *
     * @ORM\Column(name="promo", type="text", length=65535, nullable=false)
     */
    private $promo;

    /**
     * @var \Ecole
     *
     * @ORM\ManyToOne(targetEntity="Ecole")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ecole", referencedColumnName="id_ecole")
     * })
     */
    private $idEcole;

    public function __toString()
    {
        return $this->promo;
    }

    public function getIdPromo(): ?string
    {
        return $this->idPromo;
    }

    public function getPromo(): ?string
    {
        return $this->promo;
    }

    public function setPromo(string $promo): self
    {
        $this->promo = $promo;

        return $this;
    }

    public function getIdEcole(): ?Ecole
    {
        return $this->idEcole;
    }

    public function setIdEcole(?Ecole $idEcole): self
    {
        $this->idEcole = $idEcole;

        return $this;
    }
}
