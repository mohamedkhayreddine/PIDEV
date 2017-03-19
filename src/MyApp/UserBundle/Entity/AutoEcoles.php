<?php

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AutoEcoles
 *
 * @ORM\Table(name="auto_ecoles", indexes={@ORM\Index(name="id_gerant", columns={"id_gerant"})})
 * @ORM\Entity
 */
class AutoEcoles
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
     * @ORM\Column(name="nom", type="string", length=30, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=200, nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="num_tel", type="string", length=20, nullable=true)
     */
    private $numTel;

    /**
     * @var string
     *
     * @ORM\Column(name="e_mail", type="string", length=50, nullable=true)
     */
    private $eMail;

    /**
     * @var string
     *
     * @ORM\Column(name="matricule_fiscal", type="string", length=20, nullable=true)
     */
    private $matriculeFiscal;

    /**
     * @var integer
     *
     * @ORM\Column(name="photo", type="integer", nullable=true)
     */
    private $photo;

    /**
     * @var integer
     *
     * @ORM\Column(name="validite", type="integer", nullable=true)
     */
    private $validite;

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

