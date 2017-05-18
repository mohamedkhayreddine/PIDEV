<?php

namespace MyApp\GestionSeanceBundle\Controller;

use MyApp\GestionSeanceBundle\Entity\Seance;
use MyApp\GestionSeanceBundle\Form\Recherche;
use MyApp\GestionSeanceBundle\Form\SeanceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use MyApp\GestionSeanceBundle\Form\RechercheType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MyAppGestionSeanceBundle:Default:index.html.twig');
    }
    public function listSeanceAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_GERANT');
        $em=$this->getDoctrine()->getManager();
        $seance=$em->getRepository('MyAppGestionSeanceBundle:Seance')->trierSeancesParDate();
        $paginator  = $this->get('knp_paginator')->paginate(
            $seance,
            $request->query->get('page', 1)/*page number*/,
            4/*limit per page*/
        );

        return $this->Render('MyAppGestionSeanceBundle:Seance:listSeance.html.twig', array(
            'data' => $paginator
        ));


    }

    /**
     * @param Request $req
     * @return Response
     */
    public function AjoutSeanceAction(Request $req)
    {
        $this->denyAccessUnlessGranted('ROLE_GERANT');
        $seance = new Seance();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(SeanceType::class, $seance);
        if ($form->handleRequest($req)->isValid()) {
            if($seance->getDateSeance()> new \DateTime('now'))
            {
                if($seance->getHeureDebut()<$seance->getHeureFin())
                {
                    $em->persist($seance);
                    $em->flush();
                    $this->get('session')->getFlashBag()->add('success','Séance Ajouté');
                }
                else{

                    $this->get('session')->getFlashBag()->add('notice','Heure de debut doit etre inferieure a l heure de fin  ');
                }

            }
            else
            {
                $this->get('session')->getFlashBag()->add('notice','verifier la date de la séance ');
            }

        }
        return $this->render('MyAppGestionSeanceBundle:Seance:AjoutSeance.html.twig', array('f' => $form->createView()));

    }



    function findMoniteurDQLAction()
    {
        $em=$this->getDoctrine()->getManager();
        $moniteur=$em->getRepository("MyAppUserBundle:User")->findMoniteurDQL();
        return $this->render('@MyAppGestionSeance/Seance/listSeance.html.twig',array('m'=>$moniteur));
    }
    function modifierSeanceAction(Request $request,$id)
    {
        $this->denyAccessUnlessGranted('ROLE_GERANT');
        $em=$this->getDoctrine()->getManager();
        $seance=$em->getRepository('MyAppGestionSeanceBundle:Seance')->find($id);
        $Form=$this->createForm(SeanceType::class,$seance);
        $Form->handleRequest($request);
        if ($Form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($seance);
            $em->flush();
            return $this->redirectToRoute('lsitSeance');
        }
        return $this->render('MyAppGestionSeanceBundle:Seance:ModifSeance.html.twig',array('f'=>$Form->createView()));

    }
    function SupprimerSeanceAction($id)
    {
        $this->denyAccessUnlessGranted('ROLE_GERANT');

        $em=$this->getDoctrine()->getManager();
        $seance=$em->getRepository('MyAppGestionSeanceBundle:Seance')->find($id);
        $em->remove($seance);
        $em->flush();
        return $this->redirectToRoute('lsitSeance');


    }
    function PlaninigAction()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $em=$this->getDoctrine()->getManager();

        $id=$this->get("security.token_storage")->getToken()->getUser();
        //var_dump($id);
        $seance=$em->getRepository('MyAppGestionSeanceBundle:Seance')->findUserSeance($id);
        //var_dump($seance);
        return $this->render('MyAppGestionSeanceBundle:Seance:SeancesUser.html.twig',array('data'=>$seance));


    }
    function PlaninigMAction()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $em=$this->getDoctrine()->getManager();

        $id=$this->get("security.token_storage")->getToken()->getUser();
        //var_dump($id);
        $seance=$em->getRepository('MyAppGestionSeanceBundle:Seance')->findMoniteurSeance($id);
        //var_dump($seance);
        return $this->render('MyAppGestionSeanceBundle:Seance:SeancesMoniteur.html.twig',array('data'=>$seance));


    }
    public function pdfAction($id)
    {
        $em= $this->getDoctrine()->getManager();
        $candidat=$this->get("security.token_storage")->getToken()->getUser();

        $seances = $em->getRepository('MyAppGestionSeanceBundle:Seance')
            ->findUserSeance($id);
        $html = $this->renderView('MyAppGestionSeanceBundle:Seance:MonEmploi.html.twig',array(
            'candidat'=>$candidat,
            'data'=>$seances
        ));

        $filename = sprintf('MonEmploi-%s.pdf', date('Y-m-d'));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
            ]
        );


    }
    public function pdfMAction($id)
    {
        $em= $this->getDoctrine()->getManager();
        $candidat=$this->get("security.token_storage")->getToken()->getUser();

        $seances = $em->getRepository('MyAppGestionSeanceBundle:Seance')
            ->findMoniteurSeance($id);
        $html = $this->renderView('MyAppGestionSeanceBundle:Seance:MonEmploi.html.twig',array(
            'candidat'=>$candidat,
            'data'=>$seances
        ));

        $filename = sprintf('MonEmploi-%s.pdf', date('Y-m-d'));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
            ]
        );


    }
    public function rechercheAction (Request $request)
    {
        $seance = new Seance();
        $em = $this->getDoctrine()->getManager();
        $Form = $this->createForm(Recherche::class, $seance);
        $Form->handleRequest($request);
        if ($Form->isValid()) {
            $model = $em->getRepository("MyAppGestionSeanceBundle:Seance")->findBy(array('dateSeance' => $seance->getDateSeance()));
        } else {
            $model = $em->getRepository("MyAppGestionSeanceBundle:Seance")->findAll();
        }
        return $this->render("MyAppGestionSeanceBundle/Seance/listSeance.html.twig", array('f' => $Form->createView(), 'data' => $model));

    }
    /* public function rechercherAction() {
         $request = $this->container->get('request_stack')->getCurrentRequest();
         $em = $this->container->get('doctrine')->getEntityManager();
         if ($request->isXmlHttpRequest()) {

             $motcle = $request->request->get('motcle');
             $query = $em->createQuery("SELECT m FROM MyAppGestionSeanceBundle:Seance m WHERE m.idCnadidat LIKE '$motcle%'");
             $seances = $query->getResult();


             return $this->container->get('templating')->renderResponse('MyAppGestionSeanceBundle:Seance:RechercheSeance.html.twig', array(
                 'data' => $seances
             ));
         } else {
             return $this->listSeanceAction();
         }
     }
     public function rechercherSeanceAction(Request $Request)
     {
         $em=$this->getDoctrine()->getManager();
         $seance=$em->getRepository('MyAppGestionSeanceBundle:Seance')->findAll();

         if($Request->isMethod('POST'))

         {
             $search=$Request->get('idCandidat');
             $seance=$em->getRepository('MyAppGestionSeanceBundle:Seance')->findBy(array("dateSeance"=>$search));

         }

         return $this->render('MyAppGestionSeanceBundle/Seance/listSeance.html.twig',
             array("data"=>$seance));


     }*/
    public function rechercherAjaxAction($motcle)
    {


        $em=$this->getDoctrine()->getManager();
        $seances=$em->getRepository('MyAppGestionSeanceBundle:Seance')->findSeanceBydate($motcle);//select * from model
        //   $quest = new Question() ;
        //  $form = $this->createForm(QuestionType::class,$quest);
        //  $formrecherche = $this->createForm(QuestionRechercheType::class);

        //   $data = array(
        //       'attending'=>true
        //    );
        $i=0;
        //   $test = array_reverse($questions);
        foreach ( $seances as $seance){
            $v[$i] = array( "id"=>$seance->getId(),"date"=> $seance->getDateSeance(),"Moniteur"=>$seance->getIdCandidat(),
                "Candidat"=>$seance->getIdMoniteur, "HeureDebut"=> $seance->getHeureDebut(),
                "HeureFin"=>$seance->getHeureFin()

            );
//            }

            $i++;
        }
        //       $response = new JsonResponse();


        $reponse = new JsonResponse($v);
        //    $reponse->headers->set('Content-Type','application/json');
        return $reponse;




    }








}
