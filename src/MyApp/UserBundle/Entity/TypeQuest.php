<?php

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeQuest
 *
 * @ORM\Table(name="type_quest")
 * @ORM\Entity
 */
class TypeQuest
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="typequest", type="string", length=100, nullable=false)
     */
    private $typequest;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbr_quest", type="integer", nullable=true)
     */
    private $nbrQuest;


}

