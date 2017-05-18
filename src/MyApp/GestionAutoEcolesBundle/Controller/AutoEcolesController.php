<?php
/**
 * Created by PhpStorm.
 * User: fakhri
 * Date: 21/03/2017
 * Time: 19:28
 */

namespace MyApp\GestionAutoEcolesBundle\Controller;


use MyApp\GestionAutoEcolesBundle\Form\AutoEcolesType;
use MyApp\GestionAutoEcolesBundle\Form\AutoEcoleType;
use MyApp\UserBundle\Entity\AutoEcoles;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

use ReCaptcha\ReCaptcha;

class AutoEcolesController extends Controller


{


    public function affichageAction(Request $request)
    {

        $em=$this->getDoctrine()->getManager();

        $randonnee=$em->getRepository("MyAppUserBundle:AutoEcoles")->findDQL();



        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $randonnee,
            $request->query->get('page', 1)/*page number*/,
            2/*limit per page*/
        );
        return $this->render('MyAppGestionAutoEcolesBundle:AutoEcoles:AutoEcoles.html.twig', array('pagination' => $pagination));

    }


    function ajoutAction(Request $request)
    {
        {
            $em=$this->getDoctrine()->getManager();


            $dql = "SELECT COUNT(o.id) AS sauto FROM MyAppUserBundle:AutoEcoles o" ;
            $sauto = $em->createQuery($dql)
                ->getSingleScalarResult() ;
            ; // array of User objects


            $quer ="SELECT COUNT(u.id) AS suser FROM MyAppUserBundle:User u" ;
            $suser= $em->createQuery($quer)
                ->getSingleScalarResult();
            ; // array of User objects
            $resuu=$sauto-$suser;



            $ecole = new AutoEcoles();
            $form = $this->createForm(AutoEcolesType::class, $ecole);
            if($resuu>0)
            {

                echo "<script>alert(\"je te conseille de faire un deal car il y'a un surcharge des ecoles\")</script>";

            }
            if ($form->handleRequest($request)->isValid()) {


                $ecole->setImageFile($form->get('imageFile')->getData());
             //   $ecole->setImageName($form->get('imageFile')->getName());
                var_dump($ecole->getImageFile()->getPath());
                var_dump($ecole->getImageFile());

                $em->persist($ecole);//insert into table
                $em->flush();//execution






                return $this->redirectToRoute('Affichage', array('id' => $ecole->getId()));
            }

            return $this->render('MyAppGestionAutoEcolesBundle:AutoEcoles:Ajout.html.twig', array(
                'ecole' => $ecole,
                'f' => $form->createView(),
            ));
        }
    }

    function supprimerAction($id)
{
    $em=$this->getDoctrine()->getManager();
    $model=$em->getRepository('MyAppUserBundle:AutoEcoles')->find($id);
    $em->remove($model);
    $em->flush();
    return $this->redirectToRoute('Affichage');

}
    function modifierAction($nom,Request $request){

        $em=$this->getDoctrine()->getManager();
        $classe = $em->getRepository('MyAppUserBundle:AutoEcoles')->find($nom);
        $form=$this->createForm(AutoEcoleType::class,$classe);

        if ($form->handleRequest($request)->isValid()){

            $em->persist($classe);
            $em->flush();

            return $this->redirectToRoute('Affichage');

        }

        return $this->render('@MyAppGestionAutoEcoles/AutoEcoles/modif.html.twig',array('f'=>$form->createView()));



    }




    public function indexAction()
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('MyAppUserBundle:AutoEcoles')
        ;

        $listCountries = $repository->findBy(
            array(),                      // Critere
            array('id' => 'desc'),        // Tri
            null,                         // Limite
            null                          // Offset
        );


        return $this->render('MyAppGestionAutoEcolesBundle:AutoEcoles:AutoEcoles.html.twig', array(
            'listCountries' => $listCountries,
        ));

    }


}