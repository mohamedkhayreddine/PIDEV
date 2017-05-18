<?php

namespace MyApp\QuestionBundle\Controller;

use duncan3dc\Speaker\Providers\VoiceRssProvider;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use duncan3dc\Speaker\TextToSpeech;
use duncan3dc\Speaker\Providers\GoogleProvider;

class DefaultController extends Controller
{
    public function indexAction()
    {




    // soltanas ($login, $application, $password, $voice = null, $speed = null)
//   $google = new \duncan3dc\Speaker\Providers\AcapelaProvider();
 //  $google = new \duncan3dc\Speaker\Providers\VoxygenProvider();
  // $google = new \duncan3dc\Speaker\Providers\PicottsProvider();

        $google = new \duncan3dc\Speaker\Providers\VoiceRssProvider("85e10a48b7d14896b80a143f073e430f","fr",10);
        $tts = new \duncan3dc\Speaker\TextToSpeech("Bonjour", $google);
        file_put_contents("C:/wamp64/tmp/hello.mp3", $tts->getAudioData());


        $em=$this->getDoctrine()->getManager();
        $typequestion=$em->getRepository('MyAppQuestionBundle:TypeQuestion')->findAll();
        $questions=$em->getRepository('MyAppQuestionBundle:Question')->findBy(array('typequest'=>$typequestion[1]));
        shuffle($questions);
        $q = array();
        for ($i=1;$i<=10;$i++){
            $q[$i] = $questions[$i];
        }


        return $this->render('MyAppQuestionBundle:Test:flipbook.html.twig',array('l'=>$q ));
    }
}
