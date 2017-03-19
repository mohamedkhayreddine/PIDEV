<?php

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cours
 *
 * @ORM\Table(name="cours", indexes={@ORM\Index(name="id_moniteur", columns={"id_moniteur"}), @ORM\Index(name="id_type", columns={"id_type"})})
 * @ORM\Entity
 */
class Cours
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
     * @ORM\Column(name="titre", type="string", length=250, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=1000, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="piece_joint", type="blob", nullable=true)
     */
    private $pieceJoint;

    /**
     * @var string
     *
     * @ORM\Column(name="date_depo", type="string", length=100, nullable=false)
     */
    private $dateDepo;

    /**
     * @var string
     *
     * @ORM\Column(name="nb_page", type="string", length=20, nullable=false)
     */
    private $nbPage;

    /**
     * @var integer
     *
     * @ORM\Column(name="validation", type="integer", nullable=false)
     */
    private $validation;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_moniteur", referencedColumnName="id")
     * })
     */
    private $idMoniteur;

    /**
     * @var \TypeQuest
     *
     * @ORM\ManyToOne(targetEntity="TypeQuest")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type", referencedColumnName="id")
     * })
     */
    private $idType;


}

