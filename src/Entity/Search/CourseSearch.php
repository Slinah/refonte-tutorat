<?php

namespace App\Entity\Search;

use Doctrine\ORM\Mapping as ORM;

Class CourseSearch {

    /**
     * @var String|null
     */
    private $intitule;

    /**
     * @var \DateTime|null
     */
    private $date;

    /**
     * @var \Matiere|null
     *
     * @ORM\ManyToOne(targetEntity="Matiere")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_matiere", referencedColumnName="id_matiere")
     * })
     */
    private $idMatiere;

    /**
     * @var \Promo|null
     *
     * @ORM\ManyToOne(targetEntity="Promo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_promo", referencedColumnName="id_promo")
     * })
     */
    private $idPromo;

    /**
     * @return String|null
     */
    public function getIntitule(): ?String
    {
        return $this->intitule;
    }

    /**
     * @param String|null $intitule
     */
    public function setIntitule(?String $intitule): void
    {
        $this->intitule = $intitule;
    }

    /**
     * @return \DateTime|null
     */
    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime|null $date
     */
    public function setDate(?\DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return \Matiere|null
     */
    public function getIdMatiere(): ?\App\Entity\Matiere
    {
        return $this->idMatiere;
    }

    /**
     * @param \App\Entity\Matiere|null $idMatiere
     */
    public function setIdMatiere(?\App\Entity\Matiere $idMatiere): void
    {
        $this->idMatiere = $idMatiere;
    }

    /**
     * @return \Promo|null
     */
    public function getIdPromo(): ?\App\Entity\Promo
    {
        return $this->idPromo;
    }

    /**
     * @param \App\Entity\Promo|null $idPromo
     */
    public function setIdPromo(?\App\Entity\Promo $idPromo): void
    {
        $this->idPromo = $idPromo;
    }


}