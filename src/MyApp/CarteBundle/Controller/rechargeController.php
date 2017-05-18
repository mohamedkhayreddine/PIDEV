<?php

namespace MyApp\CarteBundle\Controller;


use MyApp\CarteBundle\Entity\Recharge;
use MyApp\CarteBundle\Form\RechargeCandidat;
use MyApp\CarteBundle\Form\RechargeCandidatType;
use MyApp\CarteBundle\Form\RechargeModifType;
use MyApp\CarteBundle\Form\RechargeType;
use MyApp\CarteBundle\MyAppCarteBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class rechargeController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    function AjoutCarteRecharfeAction(Request $req)
    {$em = $this->getDoctrine()->getManager();
        //$cartebd = $em->getRepository('MyAppCarteBundle:recharge')->find();
        $recharge = new Recharge();
        $form = $this->createForm(RechargeType::class, $recharge);

        if ($form->handleRequest($req)->isValid()) {
            $datenow= new \DateTime('now');

            $numcarte=random_int(00000001,99999999);
            //var_dump($numcarte);
            $recharge->setValide(0);
            $recharge->setDatecarte($datenow);
            $recharge->setNumRecharge($numcarte);
            $em->persist($recharge);
            $em->flush();

            return $this->redirectToRoute('affiche carte');

        }
        return $this->render('MyAppCarteBundle:Default:AjoutCarte.html.twig', array('f' => $form->createView()));
    }

    function listCarteRechargeAction()
    {
        $em=$this->getDoctrine()->getManager();
        $recharge=$em->getRepository('MyAppCarteBundle:Recharge')->findBy(array('valide'=>0),array('solde'=>'DESC'));//select * from modele // esm l entite w esm l bundle
        return $this->render('MyAppCarteBundle:Default:AfficheCarte.html.twig',array('f'=>$recharge));

    }

    function supprimerCarteAction($numRecharge){


        $em=$this->getDoctrine()->getManager();
        $recharge=$em->getRepository('MyAppCarteBundle:Recharge')->find($numRecharge);
        $em->remove($recharge);
        $em->flush();
        return $this->redirectToRoute('affiche carte');



    }

    function modifierCarteAction($numRecharge,Request $request){

        $em=$this->getDoctrine()->getManager();
        $recharge = $em->getRepository('MyAppCarteBundle:Recharge')->find($numRecharge);
        $form=$this->createForm(RechargeModifType::class,$recharge);

        if ($form->handleRequest($request)->isValid()){

            $em->persist($recharge);
            $em->flush();

            return $this->redirectToRoute('affiche carte');

        }

        return $this->render('MyAppCarteBundle:Default:ModifierCarte.html.twig',array('f'=>$form->createView()));



    }


    function RechargerAction(Request $request){

        $em=$this->getDoctrine()->getManager();

        $numRecharge=$request->get('numRecharge');
        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $iduser = $user->getId();
        }



        $rechuser= $em->getRepository('MyAppUserBundle:User')->find($iduser);

if ($numRecharge!=0) {
    $solde = $em->getRepository('MyAppCarteBundle:Recharge')->rechercheCarte($numRecharge);

    $valide = $em->getRepository('MyAppCarteBundle:Recharge')->recherchevalideCarte($numRecharge);

        if ($valide == 0) {
        $soldeuser = $rechuser->getSolde();
        $tot = $soldeuser + $solde;
        $rechuser->setSolde($tot);

        $modifval= $em->getRepository('MyAppCarteBundle:Recharge')->modif($numRecharge);
        $em->persist($rechuser);


        $em->flush();

}

//return $this->render('MyAppCarteBundle:Default:rechargecandidat.html.twig');
    }return $this->render('MyAppCarteBundle:Default:rechargecandidat.html.twig');
    }



}
