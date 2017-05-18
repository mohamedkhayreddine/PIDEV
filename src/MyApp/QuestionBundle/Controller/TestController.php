<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 28/03/2017
 * Time: 17:56
 */

namespace MyApp\QuestionBundle\Controller;


use MyApp\QuestionBundle\Entity\TypeQuestion;
use MyApp\QuestionBundle\Form\TypeQuestionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{

    public function faireTestAction($type)
    {
        $em=$this->getDoctrine()->getManager();
        $typequestion=$em->getRepository('MyAppQuestionBundle:TypeQuestion')->findBy(array('id'=>$type));
        $questions=$em->getRepository('MyAppQuestionBundle:Question')->findBy(array('typequest'=>$typequestion));
        shuffle($questions);
        $q = array();
        for ($i=1;$i<=10;$i++){
            $q[$i] = $questions[$i];
        }
        return $this->render('@MyAppQuestion/Test/Test.html.twig',array('l'=>$q ));


    }

    public function genererTestAction()
    {
        $em=$this->getDoctrine()->getManager();
        $questions=$em->getRepository('MyAppQuestionBundle:TypeQuestion')->findAll();
        //$form = $this->createForm(TypeQuestionType::class);
        return $this->render('@MyAppQuestion/Test/GenererTest.html.twig',array('l'=>$questions));


    }

    public function afficherResultatAction($res)
    {

        return $this->render('@MyAppQuestion/Test/AfficherResultat.html.twig',array('f'=>$res));
    }
}