<?php

namespace MyApp\CarteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="MyApp\CarteBundle\Repository\Recharge")
 * @UniqueEntity("numRecharge")
 */
class Recharge
{
    /**
     * @var integer
     *
     * @ORM\Column(name="numRecharge", type="integer", length=11, nullable=false)
     * @ORM\Id
     */
    private $numRecharge;

    /**
     * @var integer
     *
     * @ORM\Column(name="solde", type="integer", nullable=false)
     */
    private $solde;

    /**
     * @var integer
     *
     * @ORM\Column(name="valide", type="integer", nullable=true)
     */
    private $valide;

    /**
     * @return mixed
     */
    public function getValide()
    {
        return $this->valide;
    }

    /**
     * @param mixed $valide
     */
    public function setValide($valide)
    {
        $this->valide = $valide;
    }
    /**
     * @ORM\Column(type="date",length=255, nullable=false)
     */
    private $datecarte;

    /**
     * @return string
     */
    public function getNumRecharge()
    {
        return $this->numRecharge;
    }

    /**
     * @param string $numRecharge
     */
    public function setNumRecharge($numRecharge)
    {
        $this->numRecharge = $numRecharge;
    }

    /**
     * @return int
     */
    public function getSolde()
    {
        return $this->solde;
    }

    /**
     * @param int $solde
     */
    public function setSolde($solde)
    {
        $this->solde = $solde;
    }

    /**
     * @return mixed
     */
    public function getDatecarte()
    {
        return $this->datecarte;
    }

    /**
     * @param mixed $datecarte
     */
    public function setDatecarte($datecarte)
    {
        $this->datecarte = $datecarte;
    }

}

