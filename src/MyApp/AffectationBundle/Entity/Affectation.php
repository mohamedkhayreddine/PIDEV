<?php

namespace MyApp\AffectationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Affectation
 *
 * @ORM\Table(name="affectation", indexes={@ORM\Index(name="id_Candidat", columns={"id_Candidat"}), @ORM\Index(name="id_Moniteur", columns={"id_Moniteur"}), @ORM\Index(name="id_Gerant", columns={"id_Gerant"})})
 * @ORM\Entity
 */
class Affectation
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
     * @var \MyApp\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="\MyApp\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_candidat", referencedColumnName="id")
     * })
     */
    private $idCandidat;

    /**
     * @var \MyApp\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="\MyApp\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Moniteur", referencedColumnName="id")
     * })
     */
    private $idMoniteur;

    /**
     * @var \MyApp\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="\MyApp\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Gerant", referencedColumnName="id")
     * })
     */
    private $idGerant;
    /**
     * @var integer
     *
     * @ORM\Column(name="affecter", type="integer", nullable=true)
     */
    private $affecter;


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
     * @return \MyApp\UserBundle\Entity\User
     */
    public function getIdCandidat()
    {
        return $this->idCandidat;
    }

    /**
     * @param \MyApp\UserBundle\Entity\User $idCandidat
     */
    public function setIdCandidat($idCandidat)
    {
        $this->idCandidat = $idCandidat;
    }

    /**
     * @return \MyApp\UserBundle\Entity\User
     */
    public function getIdMoniteur()
    {
        return $this->idMoniteur;
    }

    /**
     * @param \MyApp\UserBundle\Entity\User $idMoniteur
     */
    public function setIdMoniteur($idMoniteur)
    {
        $this->idMoniteur = $idMoniteur;
    }

    /**
     * @return \MyApp\UserBundle\Entity\User
     */
    public function getIdGerant()
    {
        return $this->idGerant;
    }

    /**
     * @param \MyApp\UserBundle\Entity\User $idGerant
     */
    public function setIdGerant($idGerant)
    {
        $this->idGerant = $idGerant;
    }

    /**
     * @return int
     */
    public function getAffecter()
    {
        return $this->affecter;
    }

    /**
     * @param int $affecter
     */
    public function setAffecter($affecter)
    {
        $this->affecter = $affecter;
    }




}

