<?php

namespace MyApp\VoitureBundle\Controller;

use MyApp\VoitureBundle\Entity\voiture;
use MyApp\VoitureBundle\Form\voitureType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;

class voitureController extends Controller
{
    function supprimerVoitureAction($serie){
        //recupere model eli bich nfas5ou

        $em =$this->getDoctrine()->getManager(); //dorctrine = orm
        $car=$em ->getRepository('MyAppVoitureBundle:voiture')->find($serie) ;// au lieu de la req select
        $em->remove($car);
        $em->flush(); //execution
        return $this->redirectToRoute('affichtableau'); //affichage


    }






   public function affichetableuAction(Request $request ){

       $user=$this->getUser();
        $voiture=new voiture();
        $em = $this->getDoctrine()->getManager();
        //pour afficher
        $voitures =$em->getRepository('MyAppVoitureBundle:voiture')->findAll();

       $paginator  = $this->get('knp_paginator');
       $pagination = $paginator->paginate(
           $voitures, /* query NOT result */
           $request->query->getInt('page', 1)/*page number*/,
           4/*limit per page*/
       );

        $form=$this->createForm(voitureType::class,$voiture);

      // $form2=$this->createForm(voitureType::class,$voiture);



        $form->handleRequest($request);

        if($form -> isValid() )
        {

            $en=$this->getDoctrine()->getManager();
          //  $voiture->upload();
              if($voiture->getDateEntretient() >new \DateTime('now'))
              {
                  $en->persist($voiture);
                  $en->flush();
              }
              else
              {
                  $this->get('session')->getFlashBag()->add('notice','vérifier la date');
              }

           return $this->redirectToRoute('affichtableau');
        }

        return $this->render('MyAppVoitureBundle:voiture:listeVoiture.html.twig', array('form'=>$form->createView(),'voitures'=>$pagination ,'user'=>$user));

    }





    public function afficherAction()
    {

        $user=$this->getUser();
        $em=$this->getDoctrine()->getManager();
        $car=$em->getRepository('MyAppVoitureBundle:voiture')->findAll();
        return $this->render('@MyAppVoiture/voiture/galleryCars.html.twig',array("voiture"=>$car,'user'=>$user));
    }




    public function modiferVoitureAction(Request $req,$serie)
    {
        $em=$this->getDoctrine()->getManager();


        $car=$em ->getRepository('MyAppVoitureBundle:voiture')->find($serie) ;
       $car->setImageFile($car->getImageFile()) ;
        $form = $this->createForm(voitureType::class,$car);


        if($form->handleRequest($req)->isValid())
        {

            $em->persist($car);
            $em->flush();
            return $this->redirectToRoute('affichtableau');
        }

        return $this->render('@MyAppVoiture/voiture/modifier2.html.twig', array('form'=>$form->createView(), 'serie'=>$serie));
    }


/*
    public function listAction(Request $request)
    {
        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT a FROM VoitureBundle:voiture a";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),5

        );

        // parameters to template
        return $this->render('@Voiture/Default/afficheVoiturePagi.html.twig', array('pagination' => $pagination));
    }*/





    public function afficheAertAction()
    {

       //$v=new voiture();
        $em=$this->getDoctrine()->getManager();

        $user =$this->getUser();
        $id= $user->getId();
        //$v->setIdGerant($id);
        $voiture=$em->getRepository('MyAppVoitureBundle:voiture')->findBy(array('idGerant'=>$id));

        $datenow= new \DateTime('now');
        for($i = 0; $i < count($voiture); ++$i) {
            $date= $voiture[$i]->getDateEntretient();

            if(date_diff($date,$datenow)== 1)
            {
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Customer Added!'
                );
            }
        }


        return $this->render('MyAppVoitureBundle:voiture:listeVoiture.html.twig',array("voitures"=>$voiture));
    }






}
