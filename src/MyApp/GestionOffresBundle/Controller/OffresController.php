<?php

namespace MyApp\GestionOffresBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MyApp\UserBundle\Entity\Offres;
use MyApp\GestionOffresBundle\Form\OffresType;
use MyApp\GestionOffresBundle\Form\OffreType;
use Symfony\Component\HttpFoundation\JsonResponse;

use MyApp\GestionOffresBundle\Repository\OffresRepository;
class OffresController extends Controller
{
    public function affichageAction(Request $request)
    {

        $em=$this->getDoctrine()->getManager();

        $offre=$em->getRepository("MyAppUserBundle:Offres")->sear();



        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $offre,
            $request->query->get('page', 1)/*page number*/,
           2/*limit per page*/
        );



        return $this->render('MyAppGestionOffresBundle::Affichage.html.twig',array('m'=>$pagination));

    }


    function ajoutAction(Request $request)
    {
        {
            $offre = new Offres();
            $form = $this->createForm('MyApp\GestionOffresBundle\Form\OffresType', $offre);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $offre->setImageFile($form->get('imageFile')->getData());

                $em = $this->getDoctrine()->getManager();
                $em->persist($offre);
                $em->flush($offre);

                return $this->redirectToRoute('Afficher_offres', array('id' => $offre->getId()));
            }

            return $this->render('MyAppGestionOffresBundle::Ajout.html.twig', array(
                'offre' => $offre,
                'f' => $form->createView(),
            ));
    }}
    public function modifierAction($id,Request $request){

        $em=$this->getDoctrine()->getManager();
        $classe = $em->getRepository('MyAppUserBundle:Offres')->find($id);
        $form=$this->createForm(OffreType::class,$classe);

        if ($form->handleRequest($request)->isValid()){

            $em->persist($classe);
            $em->flush();

            return $this->redirectToRoute('Afficher_offres');

        }

        return $this->render('MyAppGestionOffresBundle::modifier.html.twig',array('f'=>$form->createView()));



    }
    function supprimerAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $model=$em->getRepository('MyAppUserBundle:Offres')->find($id);
        $em->remove($model);
        $em->flush();
        return $this->redirectToRoute('Afficher_offres');

    }






    public function rechercheExperienceAction($nom)
    {
        //if ($request->isXmlHttpRequest()) {


        $em = $this->getDoctrine()->getManager();
        $offre=$em->getRepository('MyAppUserBundle:Offres')->recherche($nom);
        $e = null;
        foreach ($offre as $item) {
            $e[$item->getTitre()] = array(
                $item->getDescription(),
                $item->getPrix(),
                $item->getDateDeposition(),
                $item->getDateAnnulation(),


            );
        }

        $response = new JsonResponse();
        return $response->setData($e);
        // } else {
        //   throw new Exception("Erreur :p hhhhhhhhhhh");
        //}

    }
    function listReclamationCandidatAction()
    {

        $em=$this->getDoctrine()->getManager();



       $reclamation=$em->getRepository('MyAppUserBundle:Offres')->findAll();

        $e = null;
        foreach ($reclamation as $item) {
            $e[$item->getTitre()] = array(
                $item->getDescription(),
                $item->getPrix(),
                $item->getDateDeposition(),
                $item->getDateAnnulation(),


            );
        }

        $response = new JsonResponse();
        return $response->setData($e);




    }


}
