<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment {
    /**
     * @var string
     *
     * @ORM\Column(name="id_comment", type="string", length=40)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $idComment;

    /**
     * @Assert\Length(min= 5, minMessage="Votre commentaire est trop petit", maxMessage="Votre commentaire est trop grand")
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\QuestionForum", inversedBy="yes")
     * @ORM\JoinColumn(name="QuestionForum", referencedColumnName="id_question", nullable=false)
     */
    private $question;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Personne", inversedBy="commentCreated")
     * @ORM\JoinColumn(name="Personne", referencedColumnName="id_personne", nullable=false)
     */
    private $commentAuthor;

    public function getIdComment(): ?string
    {
        return $this->idComment;
    }


    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    public function getQuestion(): ?QuestionForum
    {
        return $this->question;
    }

    public function setQuestion(?QuestionForum $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getCommentAuthor(): ?Personne
    {
        return $this->commentAuthor;
    }

    public function setCommentAuthor(?Personne $commentAuthor): self
    {
        $this->commentAuthor = $commentAuthor;

        return $this;
    }
}
