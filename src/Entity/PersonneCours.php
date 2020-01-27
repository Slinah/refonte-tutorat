<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonneCoursRepository")
 */
class PersonneCours
{
    /**
     * @var \Personne
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Personne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_personne", referencedColumnName="id_personne")
     * })
     */
    private $idPersonne;

    /**
     * @var \Cours
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Cours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cours", referencedColumnName="id_cours")
     * })
     */
    private $idCours;

    /**
     * @var int
     *
     * @ORM\Column(name="rang_personne", type="integer", nullable=false)
     */
    private $rangPersonne = '0';

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idCours = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idPersonne = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdPersonne(): ?Personne
    {
        return $this->idPersonne;
    }

    public function setIdPersonne(?Personne $idPersonne): self
    {
        $this->idPersonne = $idPersonne;

        return $this;
    }

    /**
     * @return \Cours
     */
    public function getIdCours(): \Cours
    {
        return $this->idCours;
    }

    /**
     * @param \Cours $idCours
     */
    public function setIdCours(\Cours $idCours): void
    {
        $this->idCours = $idCours;
    }

    /**
     * @return int
     */
    public function getRangPersonne(): int
    {
        return $this->rangPersonne;
    }

    /**
     * @param int $rangPersonne
     */
    public function setRangPersonne(int $rangPersonne): void
    {
        $this->rangPersonne = $rangPersonne;
    }
}