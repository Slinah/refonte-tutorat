<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PersonneTag
 *
 * @ORM\Table(name="personne_tag", indexes={@ORM\Index(name="Fk_MatiereTag", columns={"id_matiere"}), @ORM\Index(name="Fk_NiveauTag", columns={"id_niveau"}), @ORM\Index(name="Fk_PersonneTag", columns={"id_personne"})})
 * @ORM\Entity
 */
class PersonneTag
{
    /**
     * @var \Matiere
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Matiere")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_matiere", referencedColumnName="id_matiere")
     * })
     */
    private $idMatiere;

    /**
     * @var \Niveau
     *
     * @ORM\ManyToOne(targetEntity="Niveau")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_niveau", referencedColumnName="id_niveau")
     * })
     */
    private $idNiveau;

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

    public function getIdMatiere(): ?Matiere
    {
        return $this->idMatiere;
    }

    public function setIdMatiere(?Matiere $idMatiere): self
    {
        $this->idMatiere = $idMatiere;

        return $this;
    }

    public function getIdNiveau(): ?Niveau
    {
        return $this->idNiveau;
    }

    public function setIdNiveau(?Niveau $idNiveau): self
    {
        $this->idNiveau = $idNiveau;

        return $this;
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


}
