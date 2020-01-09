<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Proposition
 *
 * @ORM\Table(name="proposition", indexes={@ORM\Index(name="Fk_Matiere3", columns={"id_matiere"})})
 * @ORM\Entity
 */
class Proposition
{
    /**
     * @var string
     *
     * @ORM\Column(name="id_proposition", type="string", length=40, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProposition;

    /**
     * @var string
     *
     * @ORM\Column(name="secu", type="text", length=65535, nullable=false)
     */
    private $secu;

    /**
     * @var \Matiere
     *
     * @ORM\ManyToOne(targetEntity="Matiere")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_matiere", referencedColumnName="id_matiere")
     * })
     */
    private $idMatiere;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Personne", mappedBy="idProposition")
     */
    private $idPersonne;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Promo", inversedBy="idProposition")
     * @ORM\JoinTable(name="proposition_promo",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_proposition", referencedColumnName="id_proposition")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_promo", referencedColumnName="id_promo")
     *   }
     * )
     */
    private $idPromo;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idPersonne = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idPromo = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdProposition(): ?string
    {
        return $this->idProposition;
    }

    public function getSecu(): ?string
    {
        return $this->secu;
    }

    public function setSecu(string $secu): self
    {
        $this->secu = $secu;

        return $this;
    }

    public function getIdMatiere(): ?Matiere
    {
        return $this->idMatiere;
    }

    public function setIdMatiere(?Matiere $idMatiere): self
    {
        $this->idMatiere = $idMatiere;

        return $this;
    }

    /**
     * @return Collection|Personne[]
     */
    public function getIdPersonne(): Collection
    {
        return $this->idPersonne;
    }

    public function addIdPersonne(Personne $idPersonne): self
    {
        if (!$this->idPersonne->contains($idPersonne)) {
            $this->idPersonne[] = $idPersonne;
            $idPersonne->addIdProposition($this);
        }

        return $this;
    }

    public function removeIdPersonne(Personne $idPersonne): self
    {
        if ($this->idPersonne->contains($idPersonne)) {
            $this->idPersonne->removeElement($idPersonne);
            $idPersonne->removeIdProposition($this);
        }

        return $this;
    }

    /**
     * @return Collection|Promo[]
     */
    public function getIdPromo(): Collection
    {
        return $this->idPromo;
    }

    public function addIdPromo(Promo $idPromo): self
    {
        if (!$this->idPromo->contains($idPromo)) {
            $this->idPromo[] = $idPromo;
        }

        return $this;
    }

    public function removeIdPromo(Promo $idPromo): self
    {
        if ($this->idPromo->contains($idPromo)) {
            $this->idPromo->removeElement($idPromo);
        }

        return $this;
    }

}
