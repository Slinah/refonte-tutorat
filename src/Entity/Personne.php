<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Personne
 *
 * @ORM\Table(name="personne", indexes={@ORM\Index(name="Fk_Classe", columns={"id_classe"})})
 * @ORM\Entity
 */
class Personne implements UserInterface //extends BaseUser
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
     * @ORM\Column(name="password", type="text", length=65535, nullable=false)
     */
    private $password;

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

    public function getIdPersonne(): ?string
    {
        return $this->idPersonne;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getRole(): ?int
    {
        return $this->role;
    }

    public function setRole(int $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getIdClasse(): ?Classe
    {
        return $this->idClasse;
    }

    public function setIdClasse(?Classe $idClasse): self
    {
        $this->idClasse = $idClasse;

        return $this;
    }

    /**
     * @return Collection|Archive[]
     */
    public function getIdArchive(): Collection
    {
        return $this->idArchive;
    }

    public function addIdArchive(Archive $idArchive): self
    {
        if (!$this->idArchive->contains($idArchive)) {
            $this->idArchive[] = $idArchive;
        }

        return $this;
    }

    public function removeIdArchive(Archive $idArchive): self
    {
        if ($this->idArchive->contains($idArchive)) {
            $this->idArchive->removeElement($idArchive);
        }

        return $this;
    }

    /**
     * @return Collection|Cours[]
     */
    public function getIdCours(): Collection
    {
        return $this->idCours;
    }

    public function addIdCour(Cours $idCour): self
    {
        if (!$this->idCours->contains($idCour)) {
            $this->idCours[] = $idCour;
        }

        return $this;
    }

    public function removeIdCour(Cours $idCour): self
    {
        if ($this->idCours->contains($idCour)) {
            $this->idCours->removeElement($idCour);
        }

        return $this;
    }

    /**
     * @return Collection|Proposition[]
     */
    public function getIdProposition(): Collection
    {
        return $this->idProposition;
    }

    public function addIdProposition(Proposition $idProposition): self
    {
        if (!$this->idProposition->contains($idProposition)) {
            $this->idProposition[] = $idProposition;
        }

        return $this;
    }

    public function removeIdProposition(Proposition $idProposition): self
    {
        if ($this->idProposition->contains($idProposition)) {
            $this->idProposition->removeElement($idProposition);
        }

        return $this;
    }

    public function getRoles(): array{
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
