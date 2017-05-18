<?php
namespace MyApp\QuestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 27/03/2017
 * Time: 14:34
 */

/**
 *
 * @ORM\Entity(repositoryClass="MyApp\QuestionBundle\Repository\QuestionRepository")
 * @ORM\Table(name="question", indexes={@ORM\Index(name="typequest", columns={"typequest"})})
 *
 * @Vich\Uploadable
 * @package MyApp\QuestionBundle\Entity
 */
class Question
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
     * @ORM\Column(name="contenu", type="string", length=100, nullable=false)
     */
    private $contenu;

    /**
     * @var string
     *
     * @ORM\Column(name="reponsecorrect", type="string", length=100, nullable=false)
     */
    private $reponsecorrect;

    /**
     * @var string
     *
     * @ORM\Column(name="choix1", type="string", length=100, nullable=false)
     */
    private $choix1;

    /**
     * @var string
     *
     * @ORM\Column(name="choix2", type="string", length=100, nullable=false)
     */
    private $choix2;

    /**
     * @var string
     *
     * @ORM\Column(name="choix3", type="string", length=100, nullable=false)
     */
    private $choix3;

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
     * @var TypeQuestion
     *
     * @ORM\ManyToOne(targetEntity="TypeQuestion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="typequest", referencedColumnName="id")
     * })
     */
    private $typequest;

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
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param string $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    /**
     * @return string
     */
    public function getReponsecorrect()
    {
        return $this->reponsecorrect;
    }

    /**
     * @param string $reponsecorrect
     */
    public function setReponsecorrect($reponsecorrect)
    {
        $this->reponsecorrect = $reponsecorrect;
    }

    /**
     * @return string
     */
    public function getChoix1()
    {
        return $this->choix1;
    }

    /**
     * @param string $choix1
     */
    public function setChoix1($choix1)
    {
        $this->choix1 = $choix1;
    }

    /**
     * @return string
     */
    public function getChoix2()
    {
        return $this->choix2;
    }

    /**
     * @param string $choix2
     */
    public function setChoix2($choix2)
    {
        $this->choix2 = $choix2;
    }

    /**
     * @return string
     */
    public function getChoix3()
    {
        return $this->choix3;
    }

    /**
     * @param string $choix3
     */
    public function setChoix3($choix3)
    {
        $this->choix3 = $choix3;
    }


    /**
     * @return TypeQuestion
     */
    public function getTypequest()
    {
        return $this->typequest;
    }

    /**
     * @param TypeQuestion $typequest
     */
    public function setTypequest($typequest)
    {
        $this->typequest = $typequest;
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
     * @return Question
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }








}