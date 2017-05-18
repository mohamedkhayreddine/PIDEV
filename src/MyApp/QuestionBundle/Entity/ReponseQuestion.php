<?php
namespace MyApp\QuestionBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use MyApp\UserBundle\Entity\User;

/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 27/03/2017
 * Time: 14:36
 */


/**
 * ReponseQuestion
 *
 * @ORM\Table(name="reponse_question", indexes={@ORM\Index(name="user", columns={"id"}), @ORM\Index(name="typequest", columns={"typequest"})})
 * @ORM\Entity
 */
class ReponseQuestion
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
     * @ORM\Column(name="date_exam", type="string", length=20, nullable=false)
     */
    private $dateExam;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrcorrect", type="integer", nullable=false)
     */
    private $nbrcorrect;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrerroner", type="integer", nullable=false)
     */
    private $nbrerroner;

    /**
     * @var TypeQuestion
     *
     * @ORM\ManyToOne(targetEntity="TypeQuestion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="typequest", referencedColumnName="id")
     * })
     */
    private $TypeQuestion;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="MyApp\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="User", referencedColumnName="id")
     * })
     */
    private $User;

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
    public function getDateExam()
    {
        return $this->dateExam;
    }

    /**
     * @param string $dateExam
     */
    public function setDateExam($dateExam)
    {
        $this->dateExam = $dateExam;
    }

    /**
     * @return int
     */
    public function getNbrcorrect()
    {
        return $this->nbrcorrect;
    }

    /**
     * @param int $nbrcorrect
     */
    public function setNbrcorrect($nbrcorrect)
    {
        $this->nbrcorrect = $nbrcorrect;
    }

    /**
     * @return int
     */
    public function getNbrerroner()
    {
        return $this->nbrerroner;
    }

    /**
     * @param int $nbrerroner
     */
    public function setNbrerroner($nbrerroner)
    {
        $this->nbrerroner = $nbrerroner;
    }

    /**
     * @return TypeQuestion
     */
    public function getTypeQuestion()
    {
        return $this->TypeQuestion;
    }

    /**
     * @param TypeQuestion $TypeQuestion
     */
    public function setTypeQuestion($TypeQuestion)
    {
        $this->TypeQuestion = $TypeQuestion;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->User;
    }

    /**
     * @param User $User
     */
    public function setUser($User)
    {
        $this->User = $User;
    }



}