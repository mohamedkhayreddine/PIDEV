<?php

namespace MyApp\CoursBundle\Controller;

use MyApp\CoursBundle\Entity\Cours;
use MyApp\CoursBundle\Form\CoursType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CoursMoniteurController extends Controller
{



    public function listerCoursAction(Request $request ){

        $user=$this->getUser();
        $em = $this->getDoctrine()->getManager();
        //pour afficher
        $cours =$em->getRepository('MyAppCoursBundle:Cours')->findCourMoniteur($user);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $cours, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            4/*limit per page*/
        );


        $cour =new Cours();
        $form=$this->createForm(CoursType::class,$cour);
        $form->handleRequest($request);
        if($form -> isValid() )
        {
            $cour->setIdMoniteur($user);
            $cour->setValidation(0);
            $cour->setDateDepo(new \DateTime('now'));
            $en=$this->getDoctrine()->getManager();
            $en->persist($cour);
            $en->flush();
            return $this->redirectToRoute('mesCoursMoniteur');

        }

        return $this->render('@MyAppCours/Default/listerCoursMoniteur.html.twig', array('form'=>$form->createView(),'cours'=>$pagination ));

    }






    public function modiferCourAction(Request $req,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $cour=$em ->getRepository('MyAppCoursBundle:Cours')->find($id) ;


        $form = $this->createForm(CoursType::class,$cour);


        if($form->handleRequest($req)->isValid())
        {

            $em->persist($cour);
            $em->flush();
            return $this->redirectToRoute('mesCoursMoniteur');
        }

        return $this->render('@MyAppCours/Default/modifierCourM.html.twig', array('form'=>$form->createView(),'id'=>$id));
    }












    function supprimerCourAction($id)
    {
        $em =$this->getDoctrine()->getManager();
        $cour=$em ->getRepository('MyAppCoursBundle:Cours')->find($id) ;
        $em->remove($cour);
        $em->flush();
        return $this->redirectToRoute('mesCoursMoniteur');
    }








}
