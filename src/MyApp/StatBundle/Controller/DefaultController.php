<?php

namespace MyApp\StatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function graphAction()
    {
        $em=$this->getDoctrine()->getManager();
        $statUser=$em->getRepository('MyAppUserBundle:User')->countUser();
        $statCourAdmin=$em->getRepository('MyAppCoursBundle:Cours')->countCourAdmin();
        $statCourMoniteur=$em->getRepository('MyAppCoursBundle:Cours')->countCourMoniteur();

        $stat[]=null;
        for($i = 0; $i < count($statCourAdmin); ++$i) {

            $stat[$i][0]=$statCourAdmin[$i][1];
            $stat[$i][1]=3;
            $stat[$i][2]=$statCourAdmin[$i]['month_x'];

        }
        for($i = 0; $i < count($stat); ++$i) {

            switch ($stat[$i][2]) :
                case  1: $stat[$i][2]= 'Janvier';break;
                case  2: $stat[$i][2]= 'Février';break;
                case  3: $stat[$i][2]= 'Mars';break;
                case  4: $stat[$i][2]= 'Avril';break;
                case  5: $stat[$i][2]= 'Mai';break;
                case  6: $stat[$i][2]= 'Juin';break;
                case  7: $stat[$i][2]= 'Juillet';break;
                case  8: $stat[$i][2]= 'Août';break;
                case  9: $stat[$i][2]= 'Septembre';break;
                case 10: $stat[$i][2]= 'Octobre';break;
                case 11: $stat[$i][2]= 'Novembre';break;
                case 12: $stat[$i][2]= 'Décembre';break;
            endswitch;
        }

        $statCourParMois=$em->getRepository('MyAppCoursBundle:Cours')->countCourParMois();
        for($i = 0; $i < count($statCourParMois); ++$i) {

            switch ($statCourParMois[$i]['day_x']) :
                case  1: $statCourParMois[$i]['day_x']= 'Janvier';break;
                case  2: $statCourParMois[$i]['day_x']= 'Février';break;
                case  3: $statCourParMois[$i]['day_x']= 'Mars';break;
                case  4: $statCourParMois[$i]['day_x']= 'Avril';break;
                case  5: $statCourParMois[$i]['day_x']= 'Mai';break;
                case  6: $statCourParMois[$i]['day_x']= 'Juin';break;
                case  7: $statCourParMois[$i]['day_x']= 'Juillet';break;
                case  8: $statCourParMois[$i]['day_x']= 'Août';break;
                case  9: $statCourParMois[$i]['day_x']= 'Septembre';break;
                case 10: $statCourParMois[$i]['day_x']= 'Octobre';break;
                case 11: $statCourParMois[$i]['day_x']= 'Novembre';break;
                case 12: $statCourParMois[$i]['day_x']= 'Décembre';break;
            endswitch;
        }

        for($i = 0; $i < count($statUser); ++$i) {

            switch ($statUser[$i]['roles'][0]) :
                case 'ROLE_ADMIN': $statUser[$i]['roles'][0]= 'Admin';break;
                case 'ROLE_GERANT': $statUser[$i]['roles'][0]= 'Gerant';break;
                case 'ROLE_MONITEUR': $statUser[$i]['roles'][0]= 'Moniteur';break;
                case 'ROLE_CLIENT': $statUser[$i]['roles'][0]= 'Client';break;

            endswitch;
        }




        return $this->render('@MyAppStat/Stat/stat2.html.twig', array('statUser' => $statUser , 'coursParMois'=> $statCourParMois, 'coursAdmin'=> $stat, 'coursMoniteur'=> $statCourMoniteur ));
    }
}
