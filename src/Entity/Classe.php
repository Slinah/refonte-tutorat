<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Classe
 *
 * @ORM\Table(name="classe", indexes={@ORM\Index(name="Fk_Promo", columns={"id_promo"})})
 * @ORM\Entity
 */
class Classe
{
    /**
     * @var string
     *
     * @ORM\Column(name="id_classe", type="string", length=40, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idClasse;

    /**
     * @var string
     *
     * @ORM\Column(name="classe", type="text", length=65535, nullable=false)
     */
    private $classe;

    /**
     * @var \Promo
     *
     * @ORM\ManyToOne(targetEntity="Promo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_promo", referencedColumnName="id_promo")
     * })
     */
    private $idPromo;


}
