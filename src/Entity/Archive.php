<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Archive
 *
 * @ORM\Table(name="archive", indexes={@ORM\Index(name="Fk_MatiereArchive", columns={"id_matiere"})})
 * @ORM\Entity(repositoryClass="App\Repository\ArchiveRepository")
 */
class Archive
{
    /**
     * @var string
     *
     * @ORM\Column(name="id_archive", type="string", length=40, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idArchive;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaires", type="text", length=65535, nullable=false)
     */
    private $commentaires;

    /**
     * @var int
     *
     * @ORM\Column(name="nbParticipants", type="integer", nullable=false)
     */
    private $nbparticipants;

    /**
     * @var float
     *
     * @ORM\Column(name="duree", type="float", precision=10, scale=0, nullable=false)
     */
    private $duree;

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
     * @ORM\ManyToMany(targetEntity="Promo", inversedBy="idArchive")
     * @ORM\JoinTable(name="archive_promo",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_archive", referencedColumnName="id_archive")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_promo", referencedColumnName="id_promo")
     *   }
     * )
     */
    private $idPromo;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Personne", mappedBy="idArchive")
     */
    private $idPersonne;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idPromo = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idPersonne = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdArchive(): ?string
    {
        return $this->idArchive;
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

    public function setCommentaires(string $commentaires): self
    {
        $this->commentaires = $commentaires;

        return $this;
    }

    public function getNbparticipants(): ?int
    {
        return $this->nbparticipants;
    }

    public function setNbparticipants(int $nbparticipants): self
    {
        $this->nbparticipants = $nbparticipants;

        return $this;
    }

    public function getDuree(): ?float
    {
        return $this->duree;
    }

    public function setDuree(float $duree): self
    {
        $this->duree = $duree;

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
            $idPersonne->addIdArchive($this);
        }

        return $this;
    }

    public function removeIdPersonne(Personne $idPersonne): self
    {
        if ($this->idPersonne->contains($idPersonne)) {
            $this->idPersonne->removeElement($idPersonne);
            $idPersonne->removeIdArchive($this);
        }

        return $this;
    }

}
