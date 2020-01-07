<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Promo
 *
 * @ORM\Table(name="promo", indexes={@ORM\Index(name="Fk_Ecole", columns={"id_ecole"})})
 * @ORM\Entity
 */
class Promo
{
    /**
     * @var string
     *
     * @ORM\Column(name="id_promo", type="string", length=40, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPromo;

    /**
     * @var string
     *
     * @ORM\Column(name="promo", type="text", length=65535, nullable=false)
     */
    private $promo;

    /**
     * @var \Ecole
     *
     * @ORM\ManyToOne(targetEntity="Ecole")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ecole", referencedColumnName="id_ecole")
     * })
     */
    private $idEcole;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Archive", mappedBy="idPromo")
     */
    private $idArchive;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Cours", mappedBy="idPromo")
     */
    private $idCours;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idArchive = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idCours = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
