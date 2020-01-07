<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PropositionPromo
 *
 * @ORM\Table(name="proposition_promo", indexes={@ORM\Index(name="Fk_PropositionPromo", columns={"id_proposition"}), @ORM\Index(name="Fk_PromoProposition", columns={"id_promo"})})
 * @ORM\Entity
 */
class PropositionPromo
{
    /**
     * @var \Promo
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Promo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_promo", referencedColumnName="id_promo")
     * })
     */
    private $idPromo;

    /**
     * @var \Proposition
     *
     * @ORM\ManyToOne(targetEntity="Proposition")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_proposition", referencedColumnName="id_proposition")
     * })
     */
    private $idProposition;


}
