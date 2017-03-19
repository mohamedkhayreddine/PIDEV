<?php

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReponseQuestion
 *
 * @ORM\Table(name="reponse_question", indexes={@ORM\Index(name="id_candidat", columns={"id_candidat"}), @ORM\Index(name="typequest", columns={"typequest"})})
 * @ORM\Entity
 */
class ReponseQuestion
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
     * @ORM\Column(name="date_exam", type="string", length=20, nullable=false)
     */
    private $dateExam;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrcorrect", type="integer", nullable=false)
     */
    private $nbrcorrect;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrerroner", type="integer", nullable=false)
     */
    private $nbrerroner;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_candidat", referencedColumnName="id")
     * })
     */
    private $idCandidat;

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

