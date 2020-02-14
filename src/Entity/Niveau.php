<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="niveau")
 * @ORM\Entity
 */
class Niveau
{
    /**
     * @ORM\Column(name="id_niveau", type="string", length=40)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $idNiveau;

    /**
     * @ORM\Column(name="intitule", type="text", length=65535)
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
