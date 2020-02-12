<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonneTagRepository")
 */
class PersonneTag
{
    /**
     * @var \App\Entity\Personne
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
     * @var \App\Entity\Niveau
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Niveau")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_niveau", referencedColumnName="id_niveau")
     * })
     */
    private $idNiveau;

    /**
     * @var \App\Entity\Matiere
     *
     * @ORM\ManyToOne(targetEntity="Matiere")
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

    public function getIdNiveau()
    {
        return $this->idNiveau;
    }

    /**
     * @param Niveau $idNiveau
     */
    public function setIdNiveau(Niveau $idNiveau): void
    {
        $this->idNiveau = $idNiveau;
    }

    public function getIdMatiere()
    {
        return $this->idMatiere;
    }

    /**
     * @param Matiere $idMatiere
     */
    public function setIdMatiere(Matiere $idMatiere): void
    {
        $this->idMatiere = $idMatiere;
    }
}
