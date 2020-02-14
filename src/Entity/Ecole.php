<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="ecole")
 * @ORM\Entity
 */
class Ecole
{
    /**
     * @ORM\Column(name="id_ecole", type="string", length=40)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $idEcole;

    /**
     * @ORM\Column(name="intitule", type="text", length=65535)
     */
    private $intitule;

    public function getIdEcole(): ?string
    {
        return $this->idEcole;
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
