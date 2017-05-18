<?php

namespace MyApp\AffectationBundle\Controller;

use MyApp\AffectationBundle\Entity\Affectation;
use MyApp\AffectationBundle\Form\AffectationType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class affectationController extends Controller
{


    public function afficherAction()
    {

        $user=$this->getUser();

        $em=$this->getDoctrine()->getManager();
        $aff=$em->getRepository('MyAppAffectationBundle:Affectation')->findAll();

       // $listeM=$em->getRepository('MyAppUserBundle:User')->findMoniteurByGerant($id);
       // $affect=new Affectation();
       // $form = $this->createForm(AffectationType::class,$affect);


        return $this->render('@MyAppAffectation/affectation/listeAffectation.html.twig',array("aff"=>$aff,'user'=>$user));
    }

    public function ajouterAffAction(Request $req, $id)
    {


        $em=$this->getDoctrine()->getManager();

        $aff=$em ->getRepository('MyAppAffectationBundle:Affectation')->find($id) ;
        //var_dump($candiat);


        $form = $this->createForm(AffectationType::class,$aff);

        // $a=$candiat->getNom();
        if($form->handleRequest($req)->isValid())
        {


            $aff->setAffecter(1);
            $em->persist($aff);
            $em->flush();
            return $this->redirectToRoute('listeAff');
        }

        return $this->render('@MyAppAffectation/affectation/ajoutAffectation.html.twig', array('form'=>$form->createView() ,'id'=>$id));
    }


    public function modifierAffAction(Request $req,$id)
    {


        $em=$this->getDoctrine()->getManager();

        $aff=$em ->getRepository('MyAppAffectationBundle:Affectation')->find($id) ;
        $form = $this->createForm(AffectationType::class,$aff);
        if($form->handleRequest($req)->isValid())
        {


            $aff->setId($id);
           // $aff->setAffecter(1);
            $em->persist($aff);
            $em->flush();
            return $this->redirectToRoute('listeAff');
        }

        return $this->render('@MyAppAffectation/affectation/modifierAffectation.html.twig', array('form'=>$form->createView() ,'id'=>$id));
    }



    function supprimerAffectationAction($id){
        //recupere model eli bich nfas5ou

        $em =$this->getDoctrine()->getManager(); //dorctrine = orm
        $affectation=$em ->getRepository('MyAppAffectationBundle:Affectation')->find($id) ;// au lieu de la req select
        $em->remove($affectation);
        $em->flush(); //execution
        return $this->redirectToRoute('listeAff'); //affichage


    }


}
