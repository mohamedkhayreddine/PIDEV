<?php
namespace MyApp\PubliciteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use MyApp\UserBundle\Entity\User as Utilisateur ;
use Symfony\Component\Validator\Constraints as Assert;
//use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * Publicite
 *
 * @ORM\Table(name="publicite", indexes={@ORM\Index(name="id_owner", columns={"id_owner"})})
 * @ORM\Entity(repositoryClass="MyApp\PubliciteBundle\Repository\PubliciteRepository")
 * @Vich\Uploadable
 */
class Publicite
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
     * @ORM\Column(name="titre", type="string", length=250, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=1000, nullable=false)
     */
    private $description;



    /**
     * @var date
     *
     * @ORM\Column(name="date_depo", type="date", length=100, nullable=false)
     */
    private $dateDepo;


    /**
     * @var integer
     *
     * @ORM\Column(name="validation", type="integer", nullable=false)
     */
    private $validation;



    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="MyApp\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_owner", referencedColumnName="id")
     * })
     */
    private $idowner;

    /**
     * @var date
     *
     * @ORM\Column(name="date_pub", type="date", length=100, nullable=true)
     */
    private $datePub;

    /**
     * @var date
     *
     * @ORM\Column(name="date_anulation", type="date", length=100, nullable=true)
     */
    private $dateAnnulation;



    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * @return date
     */
    public function getDateDepo()
    {
        return $this->dateDepo;
    }

    /**
     * @param date $dateDepo
     */
    public function setDateDepo($dateDepo)
    {
        $this->dateDepo = $dateDepo;
    }

    /**
     * @return int
     */
    public function getValidation()
    {
        return $this->validation;
    }

    /**
     * @param int $validation
     */
    public function setValidation($validation)
    {
        $this->validation = $validation;
    }

    /**
     * @return \Utilisateur
     */
    public function getIdowner()
    {
        return $this->idowner;
    }

    /**
     * @param \Utilisateur $idowner
     */
    public function setIdowner($idowner)
    {
        $this->idowner = $idowner;
    }

    /**
     * @return date
     */
    public function getDatePub()
    {
        return $this->datePub;
    }

    /**
     * @param date $datePub
     */
    public function setDatePub($datePub)
    {
        $this->datePub = $datePub;
    }

    /**
     * @return date
     */
    public function getDateAnnulation()
    {
        return $this->dateAnnulation;
    }

    /**
     * @param date $dateAnnulation
     */
    public function setDateAnnulation($dateAnnulation)
    {
        $this->dateAnnulation = $dateAnnulation;
    }

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="imageName")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;





    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Publicite
     */
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
     * @param string $imageName
     *
     * @return Publicite
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageName()
    {
        return $this->imageName;
    }



}