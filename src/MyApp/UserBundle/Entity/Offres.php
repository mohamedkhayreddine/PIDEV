<?php

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Offres
 *
 * @ORM\Table(name="offres", indexes={@ORM\Index(name="id_gerant", columns={"id_gerant"})})
 * @ORM\Entity
 */
class Offres
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
     * @ORM\Column(name="titre", type="string", length=100, nullable=true)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="date_deposition", type="string", length=20, nullable=true)
     */
    private $dateDeposition;

    /**
     * @var string
     *
     * @ORM\Column(name="date_annulation", type="string", length=20, nullable=true)
     */
    private $dateAnnulation;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=20, nullable=true)
     */
    private $photo;

    /**
     * @var integer
     *
     * @ORM\Column(name="prix", type="integer", nullable=true)
     */
    private $prix;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_gerant", referencedColumnName="id")
     * })
     */
    private $idGerant;


}

