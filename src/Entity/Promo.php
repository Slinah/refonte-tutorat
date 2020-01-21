<?php

namespace App\Entity;

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

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Archive", mappedBy="idPromo")
     */
    private $idArchive;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Proposition", mappedBy="idPromo")
     */
    private $idProposition;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idArchive = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idProposition = new \Doctrine\Common\Collections\ArrayCollection();
    }

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

    /**
     * @return Collection|Archive[]
     */
    public function getIdArchive(): Collection
    {
        return $this->idArchive;
    }

    public function addIdArchive(Archive $idArchive): self
    {
        if (!$this->idArchive->contains($idArchive)) {
            $this->idArchive[] = $idArchive;
            $idArchive->addIdPromo($this);
        }

        return $this;
    }

    public function removeIdArchive(Archive $idArchive): self
    {
        if ($this->idArchive->contains($idArchive)) {
            $this->idArchive->removeElement($idArchive);
            $idArchive->removeIdPromo($this);
        }

        return $this;
    }

    /**
     * @return Collection|Proposition[]
     */
    public function getIdProposition(): Collection
    {
        return $this->idProposition;
    }

    public function addIdProposition(Proposition $idProposition): self
    {
        if (!$this->idProposition->contains($idProposition)) {
            $this->idProposition[] = $idProposition;
            $idProposition->addIdPromo($this);
        }

        return $this;
    }

    public function removeIdProposition(Proposition $idProposition): self
    {
        if ($this->idProposition->contains($idProposition)) {
            $this->idProposition->removeElement($idProposition);
            $idProposition->removeIdPromo($this);
        }

        return $this;
    }

}
