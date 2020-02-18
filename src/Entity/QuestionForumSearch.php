<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

class QuestionForumSearch
{
    /**
     * @ORM\Column(name="id_question", type="string", length=40, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $idQuestion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

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
     * @ORM\Column(type="string")
     *
     */
    private $matiere;

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

    public function getMatiere()
    {
        return $this->matiere;
    }

    public function setMatiere($matiere): self
    {
        $this->matiere = $matiere;

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
