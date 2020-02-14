<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="cours", indexes={@ORM\Index(name="Fk_Matiere", columns={"id_matiere"}), @ORM\Index(name="fk_cours_promo1_idx", columns={"id_promo"})})
 * @ORM\Entity
 */
class Cours
{
    /**
     * @ORM\Column(name="id_cours", type="string", length=40, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $idCours;

    /**
     * @ORM\Column(name="intitule", type="text", length=65535)
     */
    private $intitule;

    /**
     * @ORM\Column(name="heure", type="time")
     */
    private $heure;

    /**
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @ORM\Column(name="dateCreation", type="datetime", nullable=true)
     */
    private $dateCreation;

    /**
     * @ORM\Column(name="commentaires", type="text", length=65535, nullable=true)
     */
    private $commentaires;

    /**
     * @ORM\Column(name="nbInscrits", type="integer", nullable=true)
     */
    private $nbinscrits;

    /**
     * @ORM\Column(name="nbParticipants", type="integer", nullable=true)
     */
    private $nbparticipants;

    /**
     * @ORM\Column(name="duree", type="float", precision=10, scale=0, nullable=true)
     */
    private $duree;

    /**
     * @ORM\Column(name="status", type="integer")
     */
    private $status = '0';

    /**
     * @ORM\Column(name="stage", type="integer")
     */
    private $stage = '0';

    /**
     * @ORM\Column(name="salle", type="text", length=65535, nullable=true)
     */
    private $salle;

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
     * @var \Promo
     *
     * @ORM\ManyToOne(targetEntity="Promo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_promo", referencedColumnName="id_promo")
     * })
     */
    private $idPromo;

    public function getIdCours(): ?string
    {
        return $this->idCours;
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

    public function getHeure(): ?\DateTimeInterface
    {
        return $this->heure;
    }

    public function setHeure(\DateTimeInterface $heure): self
    {
        $this->heure = $heure;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
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

    public function getCommentaires(): ?string
    {
        return $this->commentaires;
    }

    public function setCommentaires(?string $commentaires): self
    {
        $this->commentaires = $commentaires;

        return $this;
    }

    public function getNbinscrits(): ?int
    {
        return $this->nbinscrits;
    }

    public function setNbinscrits(?int $nbinscrits): self
    {
        $this->nbinscrits = $nbinscrits;

        return $this;
    }

    public function getNbparticipants(): ?int
    {
        return $this->nbparticipants;
    }

    public function setNbparticipants(?int $nbparticipants): self
    {
        $this->nbparticipants = $nbparticipants;

        return $this;
    }

    public function getDuree(): ?float
    {
        return $this->duree;
    }

    public function setDuree(?float $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStage(): ?int
    {
        return $this->stage;
    }

    public function setStage(?int $stage): self
    {
        $this->stage = $stage;

        return $this;
    }

    public function getSalle(): ?string
    {
        return $this->salle;
    }

    public function setSalle(?string $salle): self
    {
        $this->salle = $salle;

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
