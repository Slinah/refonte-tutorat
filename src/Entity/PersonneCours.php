<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonneCoursRepository")
 */
class PersonneCours
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Personne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_personne", referencedColumnName="id_personne")
     * })
     */
    private $idPersonne;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Cours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cours", referencedColumnName="id_cours")
     * })
     */
    private $idCours;

    /**
     * @ORM\Column(type="integer")
     */
    private $rangPersonne = 0;

    /**
     * @return \App\Entity\Personne
     */
    public function getIdPersonne(): \App\Entity\Personne
    {
        return $this->idPersonne;
    }

    /**
     * @param \App\Entity\Personne $idPersonne
     */
    public function setIdPersonne(\App\Entity\Personne $idPersonne): void
    {
        $this->idPersonne = $idPersonne;
    }

    /**
     * @return \App\Entity\Cours
     */
    public function getIdCours(): \App\Entity\Cours
    {
        return $this->idCours;
    }

    /**
     * @param \App\Entity\Cours $idCours
     */
    public function setIdCours(\App\Entity\Cours $idCours): void
    {
        $this->idCours = $idCours;
    }

    /**
     * @return mixed
     */
    public function getRangPersonne()
    {
        return $this->rangPersonne;
    }

    /**
     * @param mixed $rangPersonne
     */
    public function setRangPersonne($rangPersonne): void
    {
        $this->rangPersonne = $rangPersonne;
    }
}
