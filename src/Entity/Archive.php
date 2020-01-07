<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Archive
 *
 * @ORM\Table(name="archive", indexes={@ORM\Index(name="Fk_MatiereArchive", columns={"id_matiere"})})
 * @ORM\Entity
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

}
