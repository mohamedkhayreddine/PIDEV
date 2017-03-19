<?php

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AvisAutoEcole
 *
 * @ORM\Table(name="avis_auto_ecole", indexes={@ORM\Index(name="id_auto_ecole", columns={"id_auto_ecole"}), @ORM\Index(name="id_candidat", columns={"id_candidat"})})
 * @ORM\Entity
 */
class AvisAutoEcole
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
     * @var integer
     *
     * @ORM\Column(name="note", type="integer", nullable=false)
     */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=500, nullable=true)
     */
    private $commentaire;

    /**
     * @var \AutoEcoles
     *
     * @ORM\ManyToOne(targetEntity="AutoEcoles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_auto_ecole", referencedColumnName="id")
     * })
     */
    private $idAutoEcole;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_candidat", referencedColumnName="id")
     * })
     */
    private $idCandidat;


}

