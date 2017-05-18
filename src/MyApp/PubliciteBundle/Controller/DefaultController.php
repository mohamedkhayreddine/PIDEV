<?php

namespace MyApp\PubliciteBundle\Controller;

use MyApp\PubliciteBundle\Entity\Publicite;
use MyApp\PubliciteBundle\Form\PubliciteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function listerPublicitesAction(Request $request ){


        $user= $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $publicites =$em->getRepository('MyAppPubliciteBundle:Publicite')->findMesPub($user);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $publicites, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            4/*limit per page*/
        );


        $publicite =new Publicite();
        $form=$this->createForm(PubliciteType::class,$publicite);
        $form->handleRequest($request);
        if($form -> isValid() )
        {
            $publicite->setValidation(0);
            $publicite->setDateDepo(new \DateTime('now'));
            $publicite->setIdowner($user);
            $en=$this->getDoctrine()->getManager();
            $en->persist($publicite);
            $en->flush();
            return $this->redirectToRoute('listerPublicite');

        }

        return $this->render('@MyAppPublicite/Publicites/listerPubliciteUser.html.twig', array('form'=>$form->createView(),'publicites'=>$pagination ));

    }





    public function modiferPubliciteAction(Request $req,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $publicite=$em ->getRepository('MyAppPubliciteBundle:Publicite')->find($id) ;
        $publicite->setImageFile($publicite->getImageFile()) ;
        $form = $this->createForm(PubliciteType::class,$publicite);


        if($form->handleRequest($req)->isValid())
        {

            $em->persist($publicite);
            $em->flush();
            return $this->redirectToRoute('listerPublicite');
        }

        return $this->render('@MyAppPublicite/Publicites/modifierPublicite.html.twig', array('form'=>$form->createView(),'id'=>$id));
    }





    function supprimerPubliciteAction($id)
    {
        $em =$this->getDoctrine()->getManager();
        $cour=$em ->getRepository('MyAppPubliciteBundle:Publicite')->find($id) ;
        $em->remove($cour);
        $em->flush();
        return $this->redirectToRoute('listerPublicite');

    }





}
