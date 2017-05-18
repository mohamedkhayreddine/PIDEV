<?php

namespace MyApp\GestionSeanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seance
 *
 * @ORM\Table(name="seance", indexes={@ORM\Index(name="id_moniteur", columns={"id_moniteur"}), @ORM\Index(name="id_candidat", columns={"id_candidat"})})
 * @ORM\Entity(repositoryClass="MyApp\GestionSeanceBundle\Repository\SeanceRepository")
 */
class Seance
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
     * @ORM\Column(name="date_seance", type="string", length=20, nullable=false)
     */
    private $dateSeance;

    /**
     * @var string
     *
     * @ORM\Column(name="heure_debut", type="string", length=20, nullable=false)
     */
    private $heureDebut;

    /**
     * @var string
     *
     * @ORM\Column(name="heure_fin", type="string", length=20, nullable=false)
     */
    private $heureFin;

    /**
     * @var \MyApp\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="\MyApp\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_moniteur", referencedColumnName="id")
     * })
     */
    private $idMoniteur;

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
    public function getDateSeance()
    {
        return $this->dateSeance;
    }

    /**
     * @param string $dateSeance
     */
    public function setDateSeance($dateSeance)
    {
        $this->dateSeance = $dateSeance;
    }

    /**
     * @return string
     */
    public function getHeureDebut()
    {
        return $this->heureDebut;
    }

    /**
     * @param string $heureDebut
     */
    public function setHeureDebut($heureDebut)
    {
        $this->heureDebut = $heureDebut;
    }

    /**
     * @return string
     */
    public function getHeureFin()
    {
        return $this->heureFin;
    }

    /**
     * @param string $heureFin
     */
    public function setHeureFin($heureFin)
    {
        $this->heureFin = $heureFin;
    }

    /**
     * @return \MyApp\UserBundle\Entity\User
     */
    public function getIdMoniteur()
    {
        return $this->idMoniteur;
    }

    /**
     * @param \MyApp\UserBundle\Entity\User  $idMoniteur
     */
    public function setIdMoniteur($idMoniteur)
    {
        $this->idMoniteur = $idMoniteur;
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


}

