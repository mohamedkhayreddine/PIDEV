<?php

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints\Date;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Offres
 *
 * @ORM\Table(name="offres", indexes={@ORM\Index(name="id_gerant", columns={"id_gerant"})})
 * @Vich\Uploadable
 * @ORM\Entity(repositoryClass="MyApp\GestionOffresBundle\Repository\OffresRepository")
 * @package MyApp\UserBundle\Entity
 */
class Offres
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
     * @ORM\Column(name="titre", type="string", length=100, nullable=true)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var Date
     *
     * @ORM\Column(name="date_deposition", type="date", length=20, nullable=true)
     */
    private $dateDeposition;

    /**
     * @var Date
     *
     * @ORM\Column(name="date_annulation", type="date", length=20, nullable=true)
     * * @Assert\Date()
     * @Assert\Expression(
     *     "this.getDateDeposition() <= this.getDateAnnulation()",
     *     message="Il faut que la date d'annulation >= la date de deposition"
     * )
     */
    private $dateAnnulation;

    /**
     * @var File
     * @Vich\UploadableField(mapping="question_image", fileNameProperty="imageName")
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
     * @var integer
     *
     * @ORM\Column(name="prix", type="integer", nullable=true)
     */
    private $prix;

    /**
     * @var \MyApp\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="\MyApp\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_gerant", referencedColumnName="id")
     * })
     */
    private $idGerant;

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
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDateDeposition()
    {
        return $this->dateDeposition;
    }

    /**
     * @param string $dateDeposition
     */
    public function setDateDeposition($dateDeposition)
    {
        $this->dateDeposition = $dateDeposition;
    }

    /**
     * @return string
     */
    public function getDateAnnulation()
    {
        return $this->dateAnnulation;
    }

    /**
     * @param string $dateAnnulation
     */
    public function setDateAnnulation($dateAnnulation)
    {
        $this->dateAnnulation = $dateAnnulation;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param int $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return \User
     */
    public function getIdGerant()
    {
        return $this->idGerant;
    }

    /**
     * @param \User $idGerant
     */
    public function setIdGerant($idGerant)
    {
        $this->idGerant = $idGerant;
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
     * @return mixed
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * @param mixed $imageName
     * @return Offres
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }


}

