<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogsProposition
 *
 * @ORM\Table(name="logs_proposition")
 * @ORM\Entity
 */
class LogsProposition
{
    /**
     * @var string
     *
     * @ORM\Column(name="id_log", type="string", length=40, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLog;

    /**
     * @var string|null
     *
     * @ORM\Column(name="id_proposition", type="string", length=40, nullable=true, options={"default"="NULL"})
     */
    private $idProposition = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="heure", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $heure = 'NULL';


}
