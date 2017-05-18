<?php

namespace MyApp\EventsBundle\Controller;

use MyApp\EventsBundle\Entity\Event;
use MyApp\EventsBundle\Entity\Participation;
use MyApp\EventsBundle\Form\EventType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormView;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MyAppEventsBundle:Event:GestionEvents.html.twig');
    }
    public function  AjoutEventAction(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $event = new Event();

        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);
        if($event->getEventDate() > new \DateTime('now'))
        {
            if ($form->isSubmitted() && $form->isValid() ) {

                $event->setUser($this->getUser());


                $event->setCreatedDate(new \DateTime('now'));
                $em = $this->getDoctrine()->getManager();
                $em->persist($event);
                $em->flush($event);

                $this->get('session')->getFlashBag()->add('success','Evenement Ajouté');

            }

        }
        else
        {
            $this->get('session')->getFlashBag()->add('notice','Vérifier la date de votre Evenement');
            $this->redirectToRoute('ajoutEvent');
        }


        return $this->render('@MyAppEvents/Event/ajoutEvent.html.twig', array('form' => $form->createView()));


    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    function listEventsAction(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $em=$this->getDoctrine()->getManager();
        $seance=$em->getRepository('MyAppEventsBundle:Event')->TrierEvents();
        $paginator  = $this->get('knp_paginator')->paginate(
            $seance,
            $request->query->get('page', 1)/*page number*/,
            2/*limit per page*/
        );
        return $this->render('MyAppEventsBundle:Event:GestionEvents.html.twig',array('data'=>$paginator));
    }
    function SupprimerEventAction($id,Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $em=$this->getDoctrine()->getManager();
        $event=$em->getRepository('MyAppEventsBundle:Event')->find($id);
        $user = $this->get('security.token_storage')->getToken()->getUser();

        if($user->getId() !== $event->getUser()->getId()){
            $this->get('session')->getFlashBag()->add('notice',"Vous n'etes pas autorisé a gérer cet evenement");
            return $this->redirectToRoute('my_app_event_homepage');
        }
        else
        {
            $em->remove($event);
            $em->flush();

        }


        return $this->redirectToRoute('my_app_event_homepage');
    }
    function UpdateEventAction($id ,Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $em=$this->getDoctrine()->getManager();
        $event=$em->getRepository('MyAppEventsBundle:Event')->find($id);
        $Form=$this->createForm(EventType::class,$event);
        $user = $this->get('security.token_storage')->getToken()->getUser();

        if($user->getId() !== $event->getUser()->getId()){
            $this->get('session')->getFlashBag()->add('notice',"Vous n'etes pas autorisé a gérer cet évenement");
            return $this->redirectToRoute('my_app_event_homepage');

        }
        else
        {

            $Form->handleRequest($request);
            if ($Form->isValid())
            {
                $em=$this->getDoctrine()->getManager();
                $em->persist($event);
                $em->flush();
                return $this->redirectToRoute('my_app_event_homepage');
            }
        }

        return $this->render('@MyAppEvents/Event/ModifierEvent.html.twig',array('form'=>$Form->createView()));


    }
    public function showPublicEventsAction()
    {

        $em=$this->getDoctrine()->getManager();
        $seance=$em->getRepository('MyAppEventsBundle:Event')->findPublicEvents();
        return $this->render('MyAppEventsBundle:Event:showPublicEvents.html.twig',array('data'=>$seance));
    }
    public function participerAction(Request $request,$id)
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $em=$this->getDoctrine()->getManager();
        $participation = new Participation();
        $participation->setUser($this->getUser());
        $participation->setCreatedDate(new \DateTime('now'));
        $event=$em->getRepository('MyAppEventsBundle:Event')->find($id);

        $participation->setEvent($event);
        $participation->setStatus('request');
        $existance = $em->getRepository('MyAppEventsBundle:Participation')->Existe($participation->getUser()->getId(),$event->getId());
        if($existance == null)
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($participation);
            $em->flush($participation);

        }
        else
        {
            $this->get('session')->getFlashBag()->add('notice',"Vous avez déja participé a cet event");
        }



        return $this->redirectToRoute("my_app_event_homepage");



    }
    public function showParticipationAction($id)
    {
        $em=$this->getDoctrine()->getManager();

        $event=$em->getRepository('MyAppEventsBundle:Event')->find($id);

        $user = $this->get('security.token_storage')->getToken()->getUser();

        if($user->getId() !== $event->getUser()->getId()){
            $this->get('session')->getFlashBag()->add('notice',"Vous n'etes pas autorisé a géré cet évenement");
            return $this->redirectToRoute('my_app_event_homepage');
        }

        else{

            $participation=$em->getRepository('MyAppEventsBundle:Participation')->FindParticipants($id);

        }
        return $this->render('MyAppEventsBundle:Event:ShowParticipant.html.twig',array('participation'=>$participation));
    }
    public function AcceptAction($id)
    {

        $em=$this->getDoctrine()->getManager();
        $user = $this->getUser();
        $participation=$em->getRepository('MyAppEventsBundle:Participation')->find($id);
        $event = $em->getRepository('MyAppEventsBundle:Event')->find($participation->getEvent());
        $participation->setStatus('accepted');
        $em = $this->getDoctrine()->getManager();
        $em->persist($participation);
        $em->flush($participation);

        $mailData = array(
            'user'=> $user,
            'event' => $event
        );
        $this->_sendMail($mailData);
        /* $message = \Swift_Message::newInstance()
             ->setSubject($event->getTitle())
             ->setFrom('noreplay@karhabty.tn')
             ->setTo('khayri.compte2@gmail.com')
             ->setBody("Votre demande de participation à l'évemenet a  été accepté")
         ;
         $this->get('mailer')->send($message);*/
        return $this->redirectToRoute("my_app_event_homepage");


    }
    public function DeclineAction($id)
    {

        $em=$this->getDoctrine()->getManager();
        $user = $this->getUser();
        $participation=$em->getRepository('MyAppEventsBundle:Participation')->find($id);
        $event = $em->getRepository('MyAppEventsBundle:Event')->find($participation->getEvent());

        $participation->setStatus('declined');
        $em = $this->getDoctrine()->getManager();
        $em->persist($participation);
        $em->flush($participation);

        $mailData = array(
            'user'=> $user,
            'event' => $event
        );
        $this->_sendMailRefuse($mailData);



        /*$message = \Swift_Message::newInstance()
            ->setSubject($event->getTitle())
            ->setFrom('noreplay@karhabty.tn')
            ->setTo('khayri.compte2@gmail.com')
            ->setBody("Votre demande de participation a été réfusée")
        ;
        $this->get('mailer')->send($message);*/
        return $this->redirectToRoute("my_app_event_homepage");

    }

    private function _sendMail($data = array()) {
        $env = $this->container->get('kernel')->getEnvironment();
        $user = $data['user'];
        $email = $user->getEmail();
        if($env === 'dev'){
            $email = 'kahyri.compte2@gmail.com';
        }
        $message = \Swift_Message::newInstance()
            ->setSubject('Evennements de site Carhabty')
            ->setFrom('noreply@karhabty.com')
            ->setTo(array($email))
            ->setBody(
                $this->renderView(
                    'MyAppGestionSeanceBundle:Seance:mail.html.twig',
                    array('data' => $data)
                ),
                'text/html'
            )
        ;
        $result = $this->get('mailer')->send($message);

    }
    private function _sendMailRefuse($data = array()) {
        $env = $this->container->get('kernel')->getEnvironment();
        $user = $data['user'];
        $email = $user->getEmail();
        if($env === 'dev'){
            $email = 'khayri.compte2@gmail.com';
        }
        $message = \Swift_Message::newInstance()
            ->setSubject('Evennements de site Carhabty')
            ->setFrom('noreply@karhabty.com')
            ->setTo(array($email))
            ->setBody(
                $this->renderView(
                    'MyAppGestionSeanceBundle:Seance:mailRefus.html.twig',
                    array('data' => $data)
                ),
                'text/html'
            )
        ;
        $result = $this->get('mailer')->send($message);

    }

}
