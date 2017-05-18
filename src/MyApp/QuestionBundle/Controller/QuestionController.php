<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 27/03/2017
 * Time: 16:22
 */

namespace MyApp\QuestionBundle\Controller;


use duncan3dc\Speaker\Providers\VoiceRssProvider;
use MyApp\QuestionBundle\Entity\Question;
use MyApp\QuestionBundle\Form\QuestionModifierType;
use MyApp\QuestionBundle\Form\QuestionRechercheType;
use MyApp\QuestionBundle\Form\QuestionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use MyApp\QuestionBundle\Repository\QuestionRepository;
use Symfony\Component\HttpFoundation\Response;
class QuestionController extends Controller
{


    public function ajouterAction(Request $req)
    {
        $quest = new Question() ;
        $form = $this->createForm(QuestionType::class,$quest);
        if($form->handleRequest($req)->isValid())
        {   var_dump($quest);//sout
            $em=$this->getDoctrine()->getManager();
            $quest->setImageFile($form->get('imageFile')->getData());
        //    var_dump($quest->getImageFile()->getPath());
            $em->persist($quest);
            $em->flush();

        }
        return $this->render('@MyAppQuestion/Question/AjoutQuestion.html.twig',array('f'=>$form->createView()));
    }



    public function afficherAction(Request $req)
    {
        $em=$this->getDoctrine()->getManager();
        $questions=$em->getRepository('MyAppQuestionBundle:Question')->findAll();//select * from model
        $quest = new Question() ;
        $form = $this->createForm(QuestionType::class,$quest);
        $formrecherche = $this->createForm(QuestionRechercheType::class);
        if($form->handleRequest($req)->isValid())
        {   var_dump($quest);//sout
            $em=$this->getDoctrine()->getManager();
            $quest->setImageFile($form->get('imageFile')->getData());
            //    var_dump($quest->getImageFile()->getPath());
            $em->persist($quest);
            $em->flush();

        }

        if($formrecherche -> handleRequest($req)->isValid()){
            $questions = $em->getRepository('MyAppQuestionBundle:Question')->findQuestionDQL($form->get('contenu')->getData());
            return $this->render('@MyAppQuestion/Question/affichageQuestion.html.twig',array('l'=>$questions,'f'=>$form->createView(),'r'=>$formrecherche->createView()));

        }

        return $this->render('@MyAppQuestion/Question/affichageQuestion.html.twig',array('l'=>$questions,'f'=>$form->createView(),'r'=>$formrecherche->createView()));


    }

    public function zaafficher2Action(Request $req)
    {


        $em=$this->getDoctrine()->getManager();
        $questions=$em->getRepository('MyAppQuestionBundle:Question')->findAll();//select * from model
        $quest = new Question() ;
        $form = $this->createForm(QuestionType::class,$quest);
        $formrecherche = $this->createForm(QuestionRechercheType::class);



        if($form->handleRequest($req)->isValid())
        {   var_dump($quest);//sout
            $em=$this->getDoctrine()->getManager();
            $quest->setImageFile($form->get('imageFile')->getData());
            //    var_dump($quest->getImageFile()->getPath());
            $em->persist($quest);
            $em->flush();

        }

        if($formrecherche -> handleRequest($req)->isValid()){
            $questions = $em->getRepository('MyAppQuestionBundle:Question')->findQuestionDQL($form->get('contenu')->getData());
            return $this->render('@MyAppQuestion/Question/affquestion.html.twig',array('l'=>$questions,'f'=>$form->createView(),'r'=>$formrecherche->createView()));

        }

        return $this->render('@MyAppQuestion/Question/affquestion.html.twig',array('l'=>$questions,'f'=>$form->createView(),'r'=>$formrecherche->createView()));




    }

    public function zaafficher3Action(Request $req)
    {
        $quest = new Question() ;
        $form = $this->createForm(QuestionType::class,$quest);
        $formmodif= $this->createForm(QuestionModifierType::class,$quest);
        if($form->handleRequest($req)->isValid())
        {   //var_dump($quest);//sout
            $em=$this->getDoctrine()->getManager();
            $quest->setImageFile($form->get('imageFile')->getData());

            $em->persist($quest);
            $em->flush();

            $this->zaafficher4Action();
        }

        if($formmodif->handleRequest($req)->isValid())
        {  // var_dump($quest);//sout
            $em=$this->getDoctrine()->getManager();
            $x=$req->get('id');
            $quest = $em->getRepository('MyAppQuestionBundle:Question')->findOneBy(array('id'=>$x));
            if($form->get('imageFile')->isEmpty()){


            }else
            {
                $quest->setImageFile($form->get('imageFile')->getData());
            }

            $x=$req->get('contenu');
            $quest->setContenu($x);
            $y=$req->get('ReponseCorrect');
            $quest->setReponsecorrect($y);
            $z=$req->get('Choix1');
            $quest->setChoix1($z);
            $w=$req->get('Choix2');
            $quest->setChoix2($w);
            $n=$req->get('Choix3');
            $quest->setChoix3($n);


            $em= $this-> getDoctrine()->getManager();

            $em->persist($quest);
            $em->flush();

            $this->zaafficher4Action();
        }


        return $this->render('@MyAppQuestion/Question/testCrudQuestion.html.twig',array('f'=>$form->createView(),'j'=>$formmodif->createView()));




    }

    public function zaafficher4Action()
    {


        $em=$this->getDoctrine()->getManager();
        $questions=$em->getRepository('MyAppQuestionBundle:Question')->findAll();//select * from model
     //   $quest = new Question() ;
      //  $form = $this->createForm(QuestionType::class,$quest);
      //  $formrecherche = $this->createForm(QuestionRechercheType::class);

     //   $data = array(
     //       'attending'=>true
    //    );
        $i=0;
        $test = array_reverse($questions);
        foreach ( $test as $quest){
            $v[$i] = array( "id"=>$quest->getId(),"contenu"=> $quest->getContenu(),"typeQuest"=>$quest->getTypequest()->getTypequest(),
                "reponseCorrect"=>$quest->getReponsecorrect(), "choix1"=> $quest->getChoix1(),
                "choix2"=>$quest->getChoix2(),"choix3"=> $quest->getChoix3(),
                "image"=> $quest->getImageName()
            );
//            }

            $i++;
        }
 //       $response = new JsonResponse();


        $reponse = new JsonResponse($v);
    //    $reponse->headers->set('Content-Type','application/json');
        return $reponse;




    }


    public function rechercherAction($val)
    {


        $em=$this->getDoctrine()->getManager();
        $questions=$em->getRepository('MyAppQuestionBundle:Question')->findQuestionDQL($val);//select * from model
        //   $quest = new Question() ;
        //  $form = $this->createForm(QuestionType::class,$quest);
        //  $formrecherche = $this->createForm(QuestionRechercheType::class);

        //   $data = array(
        //       'attending'=>true
        //    );
        $i=0;
     //   $test = array_reverse($questions);
        foreach ( $questions as $quest){
            $v[$i] = array( "id"=>$quest->getId(),"contenu"=> $quest->getContenu(),"typeQuest"=>$quest->getTypequest()->getTypequest(),
                "reponseCorrect"=>$quest->getReponsecorrect(), "choix1"=> $quest->getChoix1(),
                "choix2"=>$quest->getChoix2(),"choix3"=> $quest->getChoix3(),
                "image"=> $quest->getImageName()
            );
//            }

            $i++;
        }
        //       $response = new JsonResponse();


        $reponse = new JsonResponse($v);
        //    $reponse->headers->set('Content-Type','application/json');
        return $reponse;




    }


    public function supprimerAction($id)
    {

        $em= $this->getDoctrine()->getManager();
        $question=$em->getRepository('MyAppQuestionBundle:Question')->find($id);
        $em->remove($question);
        $em->flush();


        $this->zaafficher4Action();

    }


    public function testerAction()
    {

        return $this->render('@MyAppQuestion/Test/tttt.html.twig');
    }

  /*  public function ajouterAction2(Request $req)
    {   $question = new Question();

        if($req->isMethod('POST')) {
            $x = $req->get('');
            $y = $req->get('');
            $question->setImageFile($req->get('imageFile')->getData());
            $question->setLibele($y);
            $question->setPays($x);

            $em = $this->getDoctrine()->getManager();
            $em->persist($question);//insert into model
            $em->flush();//execution
        }
            $quest = new Question() ;
        $form = $this->createForm(QuestionType::class,$quest);
        $this->zaafficher4Action();
    }*/




    public function rechercheAction(Request $req,$contenu)
    {
        $em=$this->getDoctrine()->getManager();
        $questions=$em->getRepository('MyAppQuestionBundle:Question')->findQuestionDQL($contenu);//select * from model
        $quest = new Question() ;
        $form = $this->createForm(QuestionType::class,$quest);
        if($form->handleRequest($req)->isValid())
        {   var_dump($quest);//sout
            $em=$this->getDoctrine()->getManager();
            $quest->setImageFile($form->get('imageFile')->getData());
            //    var_dump($quest->getImageFile()->getPath());
            $em->persist($quest);
            $em->flush();

        }
        return $this->render('@MyAppQuestion/Question/affichageQuestion.html.twig',array('l'=>$questions,'f'=>$form->createView()));


    }


    public function supprimer2Action($id)
    {

        $em= $this->getDoctrine()->getManager();
        $question=$em->getRepository('MyAppQuestionBundle:Question')->find($id);
        $em->remove($question);
        $em->flush();


        return $this->redirectToRoute('affichageQuestion');

    }

    public function soundAction(){
        $em=$this->getDoctrine()->getManager();
        $questions=$em->getRepository('MyAppQuestionBundle:Question')->findAll();//select * from model

        foreach ($questions as $value){
            $google = new VoiceRssProvider("85e10a48b7d14896b80a143f073e430f","fr",0);

            $tts = new \duncan3dc\Speaker\TextToSpeech($value->getContenu(), $google);
            file_put_contents("C:/wamp64/www/pikarhabti/web/SoundFile/".$value->getId().".mp3", $tts->getAudioData());

        }
        return $this->render('@MyAppQuestion/Test/GenererTest.html.twig');

    }
    public function soundJsonAction(){
        $em=$this->getDoctrine()->getManager();
        $questions=$em->getRepository('MyAppQuestionBundle:Question')->findAll();//select * from model

        foreach ($questions as $value){
            $google = new \duncan3dc\Speaker\Providers\VoiceRssProvider("85e10a48b7d14896b80a143f073e430f","fr",0);

            $tts = new \duncan3dc\Speaker\TextToSpeech($value->getContenu(), $google);
            file_put_contents("C:/wamp64/www/pikarhabti/web/SoundFile/".$value->getId().".mp3", $tts->getAudioData());

        }

            $i=0;
        foreach ( $questions as $quest){
            $v[$i] = array( "id"=>$quest->getId(),"contenu"=> $quest->getContenu(),"typeQuest"=>$quest->getTypequest()->getTypequest(),
                "reponseCorrect"=>$quest->getReponsecorrect(), "choix1"=> $quest->getChoix1(),
                "choix2"=>$quest->getChoix2(),"choix3"=> $quest->getChoix3(),
                "image"=> $quest->getImageName()
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