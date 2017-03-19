<?php

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table(name="question", indexes={@ORM\Index(name="typequest", columns={"typequest"}), @ORM\Index(name="id_moniteur", columns={"id_moniteur"})})
 * @ORM\Entity
 */
class Question
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
     * @ORM\Column(name="contenu", type="string", length=100, nullable=false)
     */
    private $contenu;

    /**
     * @var string
     *
     * @ORM\Column(name="reponsecorrect", type="string", length=100, nullable=false)
     */
    private $reponsecorrect;

    /**
     * @var string
     *
     * @ORM\Column(name="choix1", type="string", length=100, nullable=false)
     */
    private $choix1;

    /**
     * @var string
     *
     * @ORM\Column(name="choix2", type="string", length=100, nullable=false)
     */
    private $choix2;

    /**
     * @var string
     *
     * @ORM\Column(name="choix3", type="string", length=100, nullable=false)
     */
    private $choix3;

    /**
     * @var string
     *
     * @ORM\Column(name="pathimg", type="string", length=100, nullable=false)
     */
    private $pathimg;

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
     *   @ORM\JoinColumn(name="typequest", referencedColumnName="id")
     * })
     */
    private $typequest;


}

