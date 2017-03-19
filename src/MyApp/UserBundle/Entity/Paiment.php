<?php

namespace MyApp\UserBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Paiment
 *
 * @ORM\Table(name="paiment", indexes={@ORM\Index(name="idCandidat", columns={"idCandidat"}), @ORM\Index(name="idGerant", columns={"idGerant"}), @ORM\Index(name="idOffre", columns={"idOffre"})})
 * @ORM\Entity
 */
class Paiment
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
     * @ORM\Column(name="date", type="string", length=255, nullable=false)
     */
    private $date;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCandidat", referencedColumnName="id")
     * })
     */
    private $idcandidat;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idGerant", referencedColumnName="id")
     * })
     */
    private $idgerant;

    /**
     * @var \Offres
     *
     * @ORM\ManyToOne(targetEntity="Offres")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idOffre", referencedColumnName="id")
     * })
     */
    private $idoffre;


}

