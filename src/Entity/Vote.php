<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoteRepository")
 */
class Vote
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="string", length=40)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Personne", inversedBy="votes")
     * @ORM\JoinColumn(name="Personne", referencedColumnName="id_personne", nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\QuestionForum", inversedBy="votes")
     * @ORM\JoinColumn(name="QuestionForum", referencedColumnName="id_question", nullable=false)
     */
    private $question;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?Personne
    {
        return $this->user;
    }

    public function setUser(?Personne $user): self
    {
        $this->user = $user;

        return $this;
    }



    public function getQuestion(): ?QuestionForum
    {
        return $this->question;
    }

    public function setQuestion(?QuestionForum $question): self
    {
        $this->question = $question;

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
}
