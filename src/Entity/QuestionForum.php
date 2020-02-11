<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
//pour pouvoir valider les données
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuestionRepository")
 */
class QuestionForum
{
    /**
     * @var string
     *
     * @ORM\Column(name="id_question", type="string", length=40, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $idQuestion;

    /**
     * @Assert\NotBlank(message="Veillez écrire votre question")
     * @Assert\Length(min= 10, max= 255, minMessage="Votre message est trop petit", maxMessage="Votre message est trop grand")
     *
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @Assert\Length(
     *   min=4,
     *   max=10000,
     *   minMessage="Votre description est trop courte !",
     *   maxMessage="Votre description est trop longue !")
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="question")
     * @ORM\JoinColumn(name="Comment", referencedColumnName="idComment", nullable=false)
     */
    private $yes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Personne", inversedBy="questionsCreated")
     * @ORM\JoinColumn(name="Personne", referencedColumnName="id_personne", nullable=false)
     */
    private $author;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vote", mappedBy="question", orphanRemoval=true)
     */
    private $votes;

    /**
     * @ORM\Column(type="integer", options={"default":0})
     */
    private $nbVote = 0;

    public function __construct()
    {
        $this->yes = new ArrayCollection();
        $this->votes = new ArrayCollection();
    }

    public function getIdQuestion(): ?string
    {
        return $this->idQuestion;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getYes(): Collection
    {
        return $this->yes;
    }

    public function addYe(Comment $ye): self
    {
        if (!$this->yes->contains($ye)) {
            $this->yes[] = $ye;
            $ye->setQuestion($this);
        }

        return $this;
    }

    public function removeYe(Comment $ye): self
    {
        if ($this->yes->contains($ye)) {
            $this->yes->removeElement($ye);
            // set the owning side to null (unless already changed)
            if ($ye->getQuestion() === $this) {
                $ye->setQuestion(null);
            }
        }

        return $this;
    }

    public function getAuthor(): ?Personne
    {
        return $this->author;
    }

    public function setAuthor(?Personne $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection|Vote[]
     */
    public function getVotes(): Collection
    {
        return $this->votes;
    }

    public function addVote(Vote $vote): self
    {
        if (!$this->votes->contains($vote)) {
            $this->votes[] = $vote;
            $vote->setQuestion($this);
        }

        return $this;
    }

    public function removeVote(Vote $vote): self
    {
        if ($this->votes->contains($vote)) {
            $this->votes->removeElement($vote);
            // set the owning side to null (unless already changed)
            if ($vote->getQuestion() === $this) {
                $vote->setQuestion(null);
            }
        }

        return $this;
    }

    public function getNbVote(): ?int
    {
        return $this->nbVote;
    }

    public function setNbVote(int $nbVote): self
    {
        $this->nbVote = $nbVote;

        return $this;
    }
}
