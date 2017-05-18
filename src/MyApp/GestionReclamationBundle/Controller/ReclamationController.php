<?php

namespace MyApp\GestionReclamationBundle\Controller;

use MyApp\GestionReclamationBundle\Entity\Reclamation;
use MyApp\GestionReclamationBundle\Form\Reclamation2Type;
use MyApp\GestionReclamationBundle\Form\ReclamationModifType;
use MyApp\GestionReclamationBundle\Form\ReclamationType;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ReclamationController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
    public function listAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $con=$this->getUser();
        $reclamation=$em->getRepository("MyAppGestionReclamationBundle:Reclamation")->findDQL($con);



        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $reclamation,
            $request->query->get('page', 1)/*page number*/,
            5/*limit per page*/
        );return $this->render('MyAppGestionReclamationBundle:Reclamation:AfficheCandidatRec.html.twig', array('pagination' => $pagination));
    }

    function ajoutReclamationAction(Request $req)
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);

        if ($form->handleRequest($req)->isValid()) {
            $con=$this->getUser();

            $datenow= new \DateTime('now');
            $em = $this->getDoctrine()->getManager();
            $reclamation->setDateReclamation($datenow);

            $reclamation->setIdcandidat($con);
            $em->persist($reclamation);
            $em->flush();

            return $this->redirectToRoute('affiche Reclamation');


        }
        return $this->render('MyAppGestionReclamationBundle:Reclamation:AjoutReclamation.html.twig', array('f' => $form->createView()));

    }

    function listReclamationCandidatAction()
    {

        $em=$this->getDoctrine()->getManager();
        $con=$this->getUser();

        //$spectale=$em->getRepository('MyAppGestionReclamationBundle:Reclamation')->affichereclamationuser($con);//select * from modele // esm l entite w esm l bundle
        $reclamation=$em->getRepository('MyAppGestionReclamationBundle:Reclamation')->findBy(array('idcandidat'=>$con),array('dateReclamation'=>'DESC'));

        $e = null;
        foreach ($reclamation as $item) {
            $e[$item->getMatricule()] = array(
                $item->getMatricule(),$item->getTitrerec(),
                $item->getStatut(),
                $item->getMotif(),
                $item->getDateReclamation(),
                $item->getIdoffre()->getTitre()

            );
        }

        $response = new JsonResponse();
        return $response->setData($e);




    }
    function listReclamationAdminAction()
    {

        $em=$this->getDoctrine()->getManager();

        $reclamation=$em->getRepository('MyAppGestionReclamationBundle:Reclamation')->findBy(array('statut'=>'en cours'),array('dateReclamation'=>'ASC'));//select * from modele // esm l entite w esm l bundle


        return $this->render('MyAppGestionReclamationBundle:Reclamation:AfficheAdminRec.html.twig',array('f'=>$reclamation));

    }
    function listReclamationAdmintraitAction()
    {

        $em=$this->getDoctrine()->getManager();

        $reclamation=$em->getRepository('MyAppGestionReclamationBundle:Reclamation')->findBy(array('statut'=>'Traiter'),array('dateReclamation'=>'ASC'));//select * from modele // esm l entite w esm l bundle


        return $this->render('MyAppGestionReclamationBundle:Reclamation:traiter.html.twig',array('f'=>$reclamation));

    }
    function listReclamationAdminrefAction()
    {

        $em=$this->getDoctrine()->getManager();

        $reclamation=$em->getRepository('MyAppGestionReclamationBundle:Reclamation')->findBy(array('statut'=>'Refuser'),array('dateReclamation'=>'ASC'));//select * from modele // esm l entite w esm l bundle


        return $this->render('MyAppGestionReclamationBundle:Reclamation:afficheRefuser.html.twig',array('f'=>$reclamation));

    }
    function listReclamationAdminAllAction()
    {

        $em=$this->getDoctrine()->getManager();

        $reclamation=$em->getRepository('MyAppGestionReclamationBundle:Reclamation')->findBy(array(),array('dateReclamation'=>'ASC'));//select * from modele // esm l entite w esm l bundle


        return $this->render('MyAppGestionReclamationBundle:Reclamation:all.html.twig',array('f'=>$reclamation));

    }
    function traiterAction($matricule,Request $request){

        $em=$this->getDoctrine()->getManager();



        $reclamation = $em->getRepository('MyAppGestionReclamationBundle:Reclamation')->find($matricule);


        $reclamation->setStatut("Traiter");


        $em->persist($reclamation);
        $em->flush();

        return $this->redirectToRoute('affiche Admin');
    }
    function RefuserAction($matricule,Request $request){

        $em=$this->getDoctrine()->getManager();
        //$quantitedata = $em->getRepository('BibliothequeBookzBundle:Booksz')->update($reference);


        $classe = $em->getRepository('MyAppGestionReclamationBundle:Reclamation')->find($matricule);


        $classe->setStatut("Refuser");

        $em->persist($classe);
        $em->flush();




        return $this->redirectToRoute('affiche Admin');
    }


    function modifierAction($matricule,Request $request){

        $em=$this->getDoctrine()->getManager();
        $reclamation = $em->getRepository('MyAppGestionReclamationBundle:Reclamation')->find($matricule);
        $titre=$reclamation->getIdoffre();
        $affiche = $em->getRepository('MyAppUserBundle:Offres')->find($titre);
        if($reclamation->getStatut()=='en cours') {
            $form = $this->createForm(ReclamationModifType::class, $reclamation);

            if ($form->handleRequest($request)->isValid()) {
                $datenow = new \DateTime('now');
                $reclamation->setStatut("en cours");
                $reclamation->setDateReclamation($datenow);
                $em->persist($reclamation);
                $em->flush();

                return $this->redirectToRoute('affiche Reclamation');

            }

            return $this->render('MyAppGestionReclamationBundle:Reclamation:ModifierReclamation.html.twig', array('f' => $form->createView(), 'c' => $affiche));
        }
        return $this->render('MyAppGestionReclamationBundle:Reclamation:nomodif.html.twig');


    }

    public function pdfAction($matricule)
    {
        $em= $this->getDoctrine()->getManager();
        $admin=$this->get("security.token_storage")->getToken()->getUser();

        $demande = $em->getRepository('MyAppGestionReclamationBundle:Reclamation')
            ->find($matricule);
        $html = $this->renderView('MyAppGestionReclamationBundle:Reclamation:pdf.html.twig',array(
            'users'=>$admin,
            'demandes'=>$demande
        ));

        $filename = sprintf('test-%s.pdf', date('Y-m-d'));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
            ]
        );


    }
    public function chartPieAction(){
        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Pourcentages des etats des reclamations');
        $ob->plotOptions->pie(array(
            'allowPointSelect' => true,
            'cursor' => 'pointer',
            'dataLabels' => array('enabled' => false),
            'showInLegend' => true
        ));
        $em= $this->container->get('doctrine')->getEntityManager();
        $classes = $em->getRepository('MyAppGestionReclamationBundle:Reclamation')->findAll();
        $totalEtudiant=0;
        foreach($classes as $classe) {
                $totalEtudiant=$totalEtudiant+1;
        }
    $data= array();

     $statr=array();
     $stat=array();
        $stattait=array();
     $b='en cours';
     $a='Refuser';
        $c='traiter';


        $ref=$em->getRepository('MyAppGestionReclamationBundle:Reclamation')->statRef($a);
        $sauto=$em->getRepository('MyAppGestionReclamationBundle:Reclamation')->stat($b);
        $straiter=$em->getRepository('MyAppGestionReclamationBundle:Reclamation')->statTrai($c);

       array_push($statr,'Refuser',(($ref) *100)/$totalEtudiant);
        array_push($stat,'en cours',(($sauto) *100)/$totalEtudiant);
        array_push($stattait,'Traiter',(($straiter) *100)/$totalEtudiant);


        //var_dump($stat);}

        array_push($data,$stat,$statr,$stattait);

        // var_dump($data);
        $ob->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));
        return $this->render('MyAppGestionReclamationBundle:Reclamation:pie.html.twig',
            array(
                'chart' => $ob
            ));
    }



    public function rechercheExperienceAction(Request $request,$nom)
    {
        //if ($request->isXmlHttpRequest()) {


            $em = $this->getDoctrine()->getManager();
            $con=$this->getUser();


            $reclamation=$em->getRepository('MyAppGestionReclamationBundle:Reclamation')->recherche($con,$nom);;
            $e = null;
            foreach ($reclamation as $item) {
                $e[$item->getMatricule()] = array($item->getMatricule(),$item->getTitrerec(),
                    $item->getStatut(),
                    $item->getMotif(),
                    $item->getDateReclamation(),$item->getIdoffre()->getTitre()
                );
            }

            $response = new JsonResponse();
            return $response->setData($e);
       // } else {
         //   throw new Exception("Erreur :p hhhhhhhhhhh");
        //}

    }


}
