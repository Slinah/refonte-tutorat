<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Cours
 *
 * @ORM\Table(name="cours", indexes={@ORM\Index(name="Fk_Matiere", columns={"id_matiere"}), @ORM\Index(name="fk_cours_promo1_idx", columns={"id_promo"})})
 * @ORM\Entity
 */
class Cours
{
    /**
     * @var string
     *
     * @ORM\Column(name="id_cours", type="string", length=40, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCours;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule", type="text", length=65535, nullable=false)
     */
    private $intitule;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure", type="time", nullable=false)
     */
    private $heure;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string|null
     *
     * @ORM\Column(name="commentaires", type="text", length=65535, nullable=true, options={"default"="NULL"})
     */
    private $commentaires = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="nbInscrits", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $nbinscrits = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="nbParticipants", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $nbparticipants = 'NULL';

    /**
     * @var float|null
     *
     * @ORM\Column(name="duree", type="float", precision=10, scale=0, nullable=true, options={"default"="NULL"})
     */
    private $duree = 'NULL';

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="secu", type="text", length=65535, nullable=false)
     */
    private $secu;

    /**
     * @var string|null
     *
     * @ORM\Column(name="salle", type="text", length=65535, nullable=true, options={"default"="NULL"})
     */
    private $salle = 'NULL';

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

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Personne", mappedBy="idCours")
     */
    private $idPersonne;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idPersonne = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdCours(): ?string
    {
        return $this->idCours;
    }

    public function setIdCours(string $idCours): self
    {
        $this->idCours = $idCours;

        return $this;
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

    public function getSecu(): ?string
    {
        return $this->secu;
    }

    public function setSecu(string $secu): self
    {
        $this->secu = $secu;

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
            $idPersonne->addIdCour($this);
        }

        return $this;
    }

    public function removeIdPersonne(Personne $idPersonne): self
    {
        if ($this->idPersonne->contains($idPersonne)) {
            $this->idPersonne->removeElement($idPersonne);
            $idPersonne->removeIdCour($this);
        }

        return $this;
    }

}
