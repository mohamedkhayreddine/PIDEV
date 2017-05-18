<?php
/**
 * Created by PhpStorm.
 * User: Aycha
 * Date: 26/03/2017
 * Time: 23:13
 */

namespace MyApp\GestionReclamationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="MyApp\GestionReclamationBundle\Repository\Reclamation")
 *
 */
class Reclamation
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $matricule;

    /**
     * @ORM\ManyToOne(targetEntity="MyApp\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="idcandidat",referencedColumnName="id",onDelete="CASCADE")
     */
    private $idcandidat;


    /**
     * @ORM\Column(type="string",length=255)
     */
    private $motif;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $titrerec;

    /**
     * @return mixed
     */
    public function getTitrerec()
    {
        return $this->titrerec;
    }

    /**
     * @param mixed $titrerec
     */
    public function setTitrerec($titrerec)
    {
        $this->titrerec = $titrerec;
    }
    /**
     * @ORM\Column(type="string",length=255,options={"default":"en cours"})
     */
    private $statut="en cours";

    /**
     * @ORM\ManyToOne(targetEntity="MyApp\UserBundle\Entity\Offres")
     * @ORM\JoinColumn(name="idoffre",referencedColumnName="id",onDelete="CASCADE")
     */
    private $idoffre;


    /**
     * @ORM\Column(type="date",length=255, nullable=false)
     */
    private $dateReclamation;

    /**
     * @return mixed
     */
    public function getMatricule()
    {
        return $this->matricule;
    }

    /**
     * @param mixed $matricule
     */
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;
    }

    /**
     * @return mixed
     */
    public function getIdcandidat()
    {
        return $this->idcandidat;
    }

    /**
     * @param mixed $idcandidat
     */
    public function setIdcandidat($idcandidat)
    {
        $this->idcandidat = $idcandidat;
    }

    /**
     * @return mixed
     */
    public function getMotif()
    {
        return $this->motif;
    }

    /**
     * @param mixed $motif
     */
    public function setMotif($motif)
    {
        $this->motif = $motif;
    }

    /**
     * @return mixed
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param mixed $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    /**
     * @return mixed
     */
    public function getIdoffre()
    {
        return $this->idoffre;
    }

    /**
     * @param mixed $idoffre
     */
    public function setIdoffre($idoffre)
    {
        $this->idoffre = $idoffre;
    }

    /**
     * @return mixed
     */
    public function getDateReclamation()
    {
        return $this->dateReclamation;
    }

    /**
     * @param mixed $dateReclamation
     */
    public function setDateReclamation($dateReclamation)
    {
        $this->dateReclamation = $dateReclamation;
    }

}