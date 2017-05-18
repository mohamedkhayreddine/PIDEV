<?php

namespace MyApp\PubliciteBundle\Controller;

use MyApp\PubliciteBundle\Form\ValidationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PubliciteAdminController extends Controller
{


    public function listerPublicitesAction(Request $request ){


        $em = $this->getDoctrine()->getManager();
        $publicites =$em->getRepository('MyAppPubliciteBundle:Publicite')->findAll();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $publicites, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            4/*limit per page*/
        );

        for($i = 0; $i < count($publicites); ++$i) {

            $date=$publicites[$i]->getDateAnnulation();
            if(new \DateTime('now')>$date){
                $publicites[$i]->setValidation(2);

            }

        }

        return $this->render('@MyAppPublicite/Publicite/listerPubliciteAdmin.html.twig', array('publicites'=>$pagination ));

    }



    public function validerPubliciteAction(Request $req,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $publicite=$em ->getRepository('MyAppPubliciteBundle:Publicite')->find($id) ;
        $publicite->setImageFile($publicite->getImageFile()) ;
        $form = $this->createForm(ValidationType::class,$publicite);


        $publiciteValider=$em ->getRepository('MyAppPubliciteBundle:Publicite')->findBy(array('validation'=>1)) ;
         if (count($publiciteValider) >3)
         {
             $this->get('session')->getFlashBag()->add('notice','Verifier lenombre des pub validé !!');
         }else{

        if($form->handleRequest($req)->isValid())
        {

            if($publicite->getDateAnnulation()>$publicite->getDatePub())
            {
                $publicite->setValidation(1);
                $em->persist($publicite);
                $em->flush();
            }
            else{

                $this->get('session')->getFlashBag()->add('notice','Verifier les dates !!');
            }
            $em->persist($publicite);
            $em->flush();
            return $this->redirectToRoute('listerPubliciteAdmin');
        }}

        return $this->render('@MyAppPublicite/Publicite/validerPub.html.twig', array('form'=>$form->createView(),'id'=>$id));
    }



}
