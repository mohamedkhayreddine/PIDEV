<?php

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recharge
 *
 * @ORM\Table(name="recharge")
 * @ORM\Entity
 */
class Recharge
{
    /**
     * @var string
     *
     * @ORM\Column(name="num_recharge", type="string", length=11, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $numRecharge;

    /**
     * @var integer
     *
     * @ORM\Column(name="solde", type="integer", nullable=false)
     */
    private $solde;

    /**
     * @var integer
     *
     * @ORM\Column(name="valide", type="integer", nullable=true)
     */
    private $valide;


}

