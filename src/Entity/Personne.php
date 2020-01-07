<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Personne
 *
 * @ORM\Table(name="personne", indexes={@ORM\Index(name="Fk_Classe", columns={"id_classe"})})
 * @ORM\Entity
 */
class Personne
{
    /**
     * @var string
     *
     * @ORM\Column(name="id_personne", type="string", length=40, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPersonne;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="text", length=65535, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="text", length=65535, nullable=false)
     */
    private $prenom;

    /**
     * @var int
     *
     * @ORM\Column(name="role", type="integer", nullable=false)
     */
    private $role = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="mdp", type="text", length=65535, nullable=false)
     */
    private $mdp;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="text", length=65535, nullable=false)
     */
    private $mail;

    /**
     * @var string|null
     *
     * @ORM\Column(name="token", type="text", length=65535, nullable=true, options={"default"="NULL"})
     */
    private $token = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="text", length=65535, nullable=true, options={"default"="NULL"})
     */
    private $image = 'NULL';

    /**
     * @var \Classe
     *
     * @ORM\ManyToOne(targetEntity="Classe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_classe", referencedColumnName="id_classe")
     * })
     */
    private $idClasse;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Archive", inversedBy="idPersonne")
     * @ORM\JoinTable(name="personne_archive",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_personne", referencedColumnName="id_personne")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_archive", referencedColumnName="id_archive")
     *   }
     * )
     */
    private $idArchive;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Cours", inversedBy="idPersonne")
     * @ORM\JoinTable(name="personne_cours",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_personne", referencedColumnName="id_personne")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_cours", referencedColumnName="id_cours")
     *   }
     * )
     */
    private $idCours;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Proposition", inversedBy="idPersonne")
     * @ORM\JoinTable(name="personne_proposition",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_personne", referencedColumnName="id_personne")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_proposition", referencedColumnName="id_proposition")
     *   }
     * )
     */
    private $idProposition;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idArchive = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idCours = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idProposition = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
