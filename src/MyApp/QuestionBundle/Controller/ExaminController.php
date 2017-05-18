<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 29/03/2017
 * Time: 02:20
 */

namespace MyApp\QuestionBundle\Controller;


use MyApp\QuestionBundle\Entity\ReponseQuestion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;

class ExaminController extends Controller
{


    public function genererExamAction()
    {
        $em=$this->getDoctrine()->getManager();
        $typequestions=$em->getRepository('MyAppQuestionBundle:TypeQuestion')->findAll();



        $q1=$em->getRepository('MyAppQuestionBundle:Question')->findBy(array('typequest'=>$typequestions[0]));
        $q2=$em->getRepository('MyAppQuestionBundle:Question')->findBy(array('typequest'=>$typequestions[1]));
        $q3=$em->getRepository('MyAppQuestionBundle:Question')->findBy(array('typequest'=>$typequestions[2]));
        shuffle($q1);
        shuffle($q2);
        shuffle($q3);
        $q = array();
        for ($i=1;$i<=10;$i++){
            $q[$i] = $q1[$i];


        }
        $q1=$q;
        for ($i=1;$i<=10;$i++){
            $q[$i] = $q1[$i];
        }
        $q2=$q;
        for ($i=1;$i<=10;$i++){
            $q[$i] = $q1[$i];
        }
        $q3=$q;



        return $this->render('@MyAppQuestion/Examin/Examin.html.twig',array('l'=>$q1,'h'=>$q2,'k'=>$q3));



    }

    public function afficherResultatAction($a,$b,$c)
    {
        $em=$this->getDoctrine()->getManager();
        $typequestions=$em->getRepository('MyAppQuestionBundle:TypeQuestion')->findAll();
         $ar = array($a,$b,$c);
        for ($i=0;$i<=2;$i++){
            $var = new ReponseQuestion();
            $date = new \DateTime('now');
            $result = $date->format('Y-m-d');
            $var->setDateExam($result);
            $var->setNbrcorrect($ar[$i]);
            $var->setNbrerroner(10-$ar[$i]);
            $var->setUser($this->getUser());
            $var->setTypeQuestion($typequestions[$i]);

            $em->persist($var);
            $em->flush();
        }


        return $this->render('@MyAppQuestion/Test/AfficherResultat.html.twig',array('f'=>$a));
    }

    public function afficherResultat2Action($a,$b,$c)
    {
        $em=$this->getDoctrine()->getManager();
        $typequestions=$em->getRepository('MyAppQuestionBundle:TypeQuestion')->findAll();
        $ar = array($a,$b,$c);
        for ($i=0;$i<=2;$i++){
            $var = new ReponseQuestion();
            $date = new \DateTime('now');
            $result = $date->format('Y-m-d');
            $var->setDateExam($result);
            $var->setNbrcorrect($ar[$i]);
            $var->setNbrerroner(10-$ar[$i]);
            $var->setUser($this->getUser());
            $var->setTypeQuestion($typequestions[$i]);

            $em->persist($var);
            $em->flush();
        }

        $i=0;
        //   $test = array_reverse($questions);
        foreach ( $typequestions as $quest){
            $v[$i] = array( "id"=>$quest->getId(),"typequest"=>$quest->getTypequest(),"nbrquest"=>$quest->getNbrQuest()
            );
//            }

            $i++;
        }
        $reponse = new JsonResponse($v);
        //    $reponse->headers->set('Content-Type','application/json');
        return $reponse;
    }

    public function PatienterAction(){
        return $this->render('@MyAppQuestion/Examin/Pasdechance.html.twig');

    }
}