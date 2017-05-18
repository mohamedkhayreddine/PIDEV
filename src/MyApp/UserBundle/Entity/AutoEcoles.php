<?php

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * AutoEcoles
 *
 * @ORM\Table(name="auto_ecoles", indexes={@ORM\Index(name="id_gerant", columns={"id_gerant"})})
 * @Vich\Uploadable
 * @ORM\Entity(repositoryClass="MyApp\GestionAutoEcolesBundle\Repository\AutoEcolesRepository")
 * @package MyApp\UserBundle\Entity
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
     * @var File
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="imageName")
     *
     * @ORM\Column(name="pathimg", type="string", length=100, nullable=false)
     */
    private $imageFile;
    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;


    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="validite", type="integer", nullable=true)
     */
    private $validite;

    /**
     * @var \MyApp\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_gerant", referencedColumnName="id")
     * })
     */
    private $idGerant;

    /**
     * @var float
     *
     * @ORM\Column(name="laltitude", type="float", nullable=true)
     */
    private $laltitude;

    /**
     * @var double
     *
     * @ORM\Column(name="longitude", type="float", nullable=true)
     */
    private $longitude;

    /**
     * @var \MyApp\UserBundle\Entity\Ville
     *
     * @ORM\ManyToOne(targetEntity="Ville")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ville", referencedColumnName="id")
     * })
     */
    private $idVille;

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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return string
     */
    public function getNumTel()
    {
        return $this->numTel;
    }

    /**
     * @param string $numTel
     */
    public function setNumTel($numTel)
    {
        $this->numTel = $numTel;
    }

    /**
     * @return string
     */
    public function getEMail()
    {
        return $this->eMail;
    }

    /**
     * @param string $eMail
     */
    public function setEMail($eMail)
    {
        $this->eMail = $eMail;
    }

    /**
     * @return string
     */
    public function getMatriculeFiscal()
    {
        return $this->matriculeFiscal;
    }

    /**
     * @param string $matriculeFiscal
     */
    public function setMatriculeFiscal($matriculeFiscal)
    {
        $this->matriculeFiscal = $matriculeFiscal;
    }



    /**
     * @return int
     */
    public function getValidite()
    {
        return $this->validite;
    }

    /**
     * @param int $validite
     */
    public function setValidite($validite)
    {
        $this->validite = $validite;
    }

    /**
     * @return \MyApp\UserBundle\Entity\User
     */
    public function getIdGerant()
    {
        return $this->idGerant;
    }

    /**
     * @return float
     */
    public function getLaltitude()
    {
        return $this->laltitude;
    }

    /**
     * @param float $laltitude
     */
    public function setLaltitude($laltitude)
    {
        $this->laltitude = $laltitude;
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }




    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @return \MyApp\UserBundle\Entity\Ville
     */
    public function getIdVille()
    {
        return $this->idVille;
    }

    /**
     * @param \MyApp\UserBundle\Entity\Ville $idVille
     */
    public function setIdVille($idVille)
    {
        $this->idVille = $idVille;
    }

    /**
     * @return mixed
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * @param mixed $imageName
     * @return AutoEcoles
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }


}

