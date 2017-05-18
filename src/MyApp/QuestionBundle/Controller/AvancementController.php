<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 31/03/2017
 * Time: 17:29
 */

namespace MyApp\QuestionBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AvancementController extends Controller
{

    public function recupererAction(){
        $em=$this->getDoctrine()->getManager();
        $typequestions=$em->getRepository('MyAppQuestionBundle:TypeQuestion')->findAll();
        //$form = $this->createForm(TypeQuestionType::class);


        $q1=$em->getRepository('MyAppQuestionBundle:ReponseQuestion')->findBy(array('TypeQuestion'=>$typequestions[0],'User'=>$this->getUser()),array('dateExam'=>'ASC'));
        $q2=$em->getRepository('MyAppQuestionBundle:ReponseQuestion')->findBy(array('TypeQuestion'=>$typequestions[1],'User'=>$this->getUser()),array('dateExam'=>'ASC'));
        $q3=$em->getRepository('MyAppQuestionBundle:ReponseQuestion')->findBy(array('TypeQuestion'=>$typequestions[2],'User'=>$this->getUser()),array('dateExam'=>'ASC'));
       return $this->render('@MyAppQuestion/Avancement/SuivreAvancement.html.twig',array('f'=>$q1,'g'=>$q2,'k'=>$q3,'l'=>$typequestions[0],'m'=>$typequestions[1],'n'=>$typequestions[2]));
    }

}