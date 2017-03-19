<?php

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuestionPropose
 *
 * @ORM\Table(name="question_propose")
 * @ORM\Entity
 */
class QuestionPropose
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
     * @ORM\Column(name="typequest", type="integer", nullable=false)
     */
    private $typequest;

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
     * @var integer
     *
     * @ORM\Column(name="id_moniteur", type="integer", nullable=false)
     */
    private $idMoniteur;


}

