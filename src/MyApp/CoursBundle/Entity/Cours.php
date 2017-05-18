<?php

namespace MyApp\CoursBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use MyApp\UserBundle\Entity\User as Utilisateur ;
use Symfony\Component\Validator\Constraints as Assert;
//use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Cours
 *
 * @ORM\Table(name="cours", indexes={@ORM\Index(name="id_moniteur", columns={"id_moniteur"}), @ORM\Index(name="id_type", columns={"id_type"})})
 * @ORM\Entity(repositoryClass="MyApp\CoursBundle\Repository\CoursRepository")
 * @Vich\Uploadable
 */
class Cours
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
     * @ORM\Column(name="nb_page", type="integer", nullable=false)
     */
    private $nbPage;

    /**
     * @var integer
     *
     * @ORM\Column(name="validation", type="integer", nullable=false)
     */
    private $validation;

    /**
     * @var \MyApp\QuestionBundle\Entity\TypeQuestion
     *
     * @ORM\ManyToOne(targetEntity="MyApp\QuestionBundle\Entity\TypeQuestion")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="id_type", referencedColumnName="id")
     * })
     */
    private $idType;

    /**
     * @var \MyApp\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="MyApp\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="id_moniteur", referencedColumnName="id")
     * })
     */
    private $idMoniteur;

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
     * @return string
     */
    public function getNbPage()
    {
        return $this->nbPage;
    }

    /**
     * @param string $nbPage
     */
    public function setNbPage($nbPage)
    {
        $this->nbPage = $nbPage;
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
     * @return \MyApp\QuestionBundle\Entity\TypeQuestion
     */
    public function getIdType()
    {
        return $this->idType;
    }

    /**
     * @param \MyApp\QuestionBundle\Entity\TypeQuestion $idType
     */
    public function setIdType($idType)
    {
        $this->idType = $idType;
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
     * @return Cours
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
     * @return Cours
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

