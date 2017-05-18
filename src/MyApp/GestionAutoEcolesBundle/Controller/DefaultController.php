<?php

namespace MyApp\GestionAutoEcolesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em=$this->getDoctrine()->getManager();
        $model=$em->getRepository('MyAppUserBundle:AutoEcoles')->findAll();//select * from offre


        return $this->render('GestionAutoEcolesBundle:Default:base.html.twig',array('points'=>$model));


           /* $em = $this->getDoctrine()->getManager();
            $villes = $em->getRepository('MyAppUserBundle:AutoEcoles')->findAll();
            foreach ($villes as $ville){

                $v[$ville->getId()] = array($ville->getLaltitude(), $ville->getLongitude());

            }
            $response = new JsonResponse();
            return $response->setData($v);*/







      /* $em=$this->getDoctrine()->getManager();
        $em = $this->get('doctrine')->getEntityManager()
            ->createQuery('SELECT (o.laltitude) FROM MyAppUserBundle:AutoEcoles o')
            ->getSingleScalarResult()
            ;

        $en = $this->get('doctrine')->getEntityManager()
            ->createQuery('SELECT (o.longitude) FROM MyAppUserBundle:AutoEcoles o')
            ->getSingleScalarResult()
            ;
        -



        $latitude=$em;
        $longitude=$en;
        $name='name';*/
       // return $this->render('GestionAutoEcolesBundle:Default:base.html.twig',array('latitude'=>$latitude,'longitude'=>$longitude));
    }
}
