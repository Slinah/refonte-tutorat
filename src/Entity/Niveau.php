<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Niveau
 *
 * @ORM\Table(name="niveau")
 * @ORM\Entity
 */
class Niveau
{
    /**
     * @var string
     *
     * @ORM\Column(name="id_niveau", type="string", length=40, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $idNiveau;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule", type="text", length=65535, nullable=false)
     */
    private $intitule;

    public function __toString()
    {
        return $this->intitule;
    }

    public function getIdNiveau(): ?string
    {
        return $this->idNiveau;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }


}
