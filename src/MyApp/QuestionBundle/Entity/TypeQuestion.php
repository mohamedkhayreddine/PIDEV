<?php

namespace MyApp\QuestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 27/03/2017
 * Time: 14:35
 */

/**
 * TypeQuest
 *
 * @ORM\Table(name="type_quest")
 * @ORM\Entity
 */
class TypeQuestion
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
     * @ORM\Column(name="nbr_quest", type="integer", nullable=false)
     */
    private $nbrQuest;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTypequest()
    {
        return $this->typequest;
    }

    /**
     * @param string $typequest
     */
    public function setTypequest($typequest)
    {
        $this->typequest = $typequest;
    }

    /**
     * @return int
     */
    public function getNbrQuest()
    {
        return $this->nbrQuest;
    }

    /**
     * @param int $nbrQuest
     */
    public function setNbrQuest($nbrQuest)
    {
        $this->nbrQuest = $nbrQuest;
    }

    function __toString()
    {
        return $this->getTypequest();
    }


}