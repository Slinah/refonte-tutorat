<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

Class PromoSearch {

    /**
     * @var string|null
     *
     * @ORM\Column(name="id_promo", type="string", length=40)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $idPromo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="promo", type="text", length=65535)
     */
    private $promo;

    public function __toString()
    {
        return $this->promo;
    }

    /**
     * @return string|null
     */
    public function getIdPromo(): ?string
    {
        return $this->idPromo;
    }

    /**
     * @param string|null $idPromo
     */
    public function setIdPromo(?string $idPromo): void
    {
        $this->idPromo = $idPromo;
    }

    /**
     * @return string|null
     */
    public function getPromo(): ?string
    {
        return $this->promo;
    }

    /**
     * @param string|null $promo
     */
    public function setPromo(?string $promo): void
    {
        $this->promo = $promo;
    }
}