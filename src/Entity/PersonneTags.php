<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonneTagsRepository")
 */
class PersonneTags
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
     * @ORM\OneToOne(targetEntity="Tags")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tag", referencedColumnName="id_tag")
     * })
     */
    private $idTag;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Matiere")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_matiere", referencedColumnName="id_matiere")
     * })
     */
    private $idMatiere;

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
     * @return mixed
     */
    public function getIdTag()
    {
        return $this->idTag;
    }

    /**
     * @param mixed $idTag
     */
    public function setIdTag($idTag): void
    {
        $this->idTag = $idTag;
    }

    /**
     * @return mixed
     */
    public function getIdMatiere()
    {
        return $this->idMatiere;
    }

    /**
     * @param mixed $idMatiere
     */
    public function setIdMatiere($idMatiere): void
    {
        $this->idMatiere = $idMatiere;
    }
}
