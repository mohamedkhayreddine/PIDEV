<?php

namespace MyApp\CoursBundle\Controller;

use MyApp\CoursBundle\Entity\Cours;
use MyApp\CoursBundle\Form\CoursType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{



    public function listerCoursAction(Request $request ){


        $em = $this->getDoctrine()->getManager();
        //pour afficher
        $cours =$em->getRepository('MyAppCoursBundle:Cours')->findAll();

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
            $cour->setValidation(1);
            $cour->setDateDepo(new \DateTime('now'));
            $en=$this->getDoctrine()->getManager();
            $en->persist($cour);
            $en->flush();
            return $this->redirectToRoute('listerCours');

        }

        return $this->render('@MyAppCours/Default/listerCours.html.twig', array('form'=>$form->createView(),'cours'=>$pagination ));

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
            return $this->redirectToRoute('listerCours');
        }

        return $this->render('@MyAppCours/Default/modifierCour.html.twig', array('form'=>$form->createView(),'id'=>$id));
    }





    public function downloadAction($id)
    {
        # Read / Show the file content in the Web Browser:

       // return $this->get('nzo_file_downloader')->readFile('uploads/tofs/anim1.png');

        # Force file download:
        $em =$this->getDoctrine()->getManager();
        $cour=$em ->getRepository('MyAppCoursBundle:Cours')->find($id) ;
        $imageName=$cour->getImageName();
        $path='images/products/'.$imageName;
     return $this->get('nzo_file_downloader')->downloadFile($path);

        # change the name of the file when downloading:

        //return $this->get('nzo_file_downloader')->downloadFile('myfolder/myfile.pdf', 'newName.pdf');
    }







    function supprimerCourAction($id)
    {
        $em =$this->getDoctrine()->getManager();
        $cour=$em ->getRepository('MyAppCoursBundle:Cours')->find($id) ;
        $em->remove($cour);
        $em->flush();
        return $this->redirectToRoute('listerCours');
    }


    public function listerCoursCandidatAction()
    {
        $em=$this->getDoctrine()->getManager();
        $cours=$em->getRepository('MyAppCoursBundle:Cours')->findCourValider();


        return $this->render('@MyAppCours/Default/listerCoursCandidat.html.twig', array('cours' => $cours));
    }






    function rechercheCoursAction($motCle)
    {

        $em = $this->getDoctrine()->getManager();

        $coursTrouvee = $em->getRepository('MyAppCoursBundle:Cours')->rechercheCoursLike($motCle);

$v[]=null;
        for($i = 0; $i < count($coursTrouvee); ++$i) {
           $cour= $coursTrouvee[$i];
            $v[$i] = array($cour->getId(), $cour->getTitre(),
                $cour->getDescription(), $cour->getDateDepo(),$cour->getNbPage() );

        }
       /* foreach ($coursTrouvee as $cour) {
//            $da= $randonnee->getDate();
//            $result = $da->format('Y-m-d');
            $v["_" . $cour->getId()] = array($cour->getId(), $cour->getTitre(),
                $cour->getDescription(), $cour->getDateDepo() );
//            }

        }*/
        $response = new JsonResponse();

        return $response->setData($v);
    }


}
