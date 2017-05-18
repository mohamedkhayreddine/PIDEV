<?php

namespace MyApp\CoursBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class coursProposerController extends Controller
{
    public function listerCoursProposerAction()
    {
        $em=$this->getDoctrine()->getManager();
        $cours=$em->getRepository('MyAppCoursBundle:Cours')->findCourPropose();

        return $this->render('@MyAppCours/Default/listerCoursProposer.html.twig', array('cours' => $cours));
    }


    public function ValiderCoursAction( $id)
    {
        $em= $this->getDoctrine()->getManager();
        $cour=$em->getRepository('MyAppCoursBundle:Cours')->find($id);
        $cour->setValidation(1);
        $em=$this->getDoctrine()->getManager();
        $em->persist($cour);
        $em->flush();
        return $this->redirectToRoute('listerCoursProposer');

    }
}
