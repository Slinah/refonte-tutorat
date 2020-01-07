<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cours
 *
 * @ORM\Table(name="cours", indexes={@ORM\Index(name="Fk_Matiere", columns={"id_matiere"})})
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
     * @var string
     *
     * @ORM\Column(name="heure", type="text", length=65535, nullable=false)
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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Promo", inversedBy="idCours")
     * @ORM\JoinTable(name="cours_promo",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_cours", referencedColumnName="id_cours")
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
     * @ORM\ManyToMany(targetEntity="Personne", mappedBy="idCours")
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

}
