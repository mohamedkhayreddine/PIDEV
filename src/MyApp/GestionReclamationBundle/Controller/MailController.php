<?php

namespace MyApp\GestionReclamationBundle\Controller;

use MyApp\GestionReclamationBundle\Form\MailType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MailController extends Controller
{
    public function contactAction(Request $request)
    {
        // Create the form according to the FormType created previously.
        // And give the proper parameters
        $form = $this->createForm(MailType::class,null,array(
            // To set the action use $this->generateUrl('route_identifier')
            'action' => $this->generateUrl('my_app_mail_homepage'),
            'method' => 'POST'
        ));

        if ($request->isMethod('POST')) {
            // Refill the fields in case the form is not valid.
            $form->handleRequest($request);

            if($form->isValid()){
                // Send mail
                if($this->sendEmail($form->getData())){

                    // Everything OK, redirect to wherever you want ! :

                    return $this->redirectToRoute('affiche Reclamation');
                }else{
                    // An error ocurred, handle
                    var_dump("Errooooor 😞");
                }
            }
        }

        return $this->render('MyAppGestionReclamationBundle:Reclamation:Mail.html.twig', array(
            'form' => $form->createView()
        ));
    }

    private function sendEmail($data){
        $myappContactMail = 'Aycha.mnasser@esprit.tn';
        $myappContactPassword = '07470255';


        $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465,'ssl')
            ->setUsername($myappContactMail)
            ->setSourceIp('0.0.0.0')

            ->setPassword($myappContactPassword);
        $con=$this->getUser();
        $mailuser=$con->getEmail();
        $username=$con->getUsername();
        $iduser=$con->getId();

        $mailer = \Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance("Reclamation au sujet de : ". $data["subject"])
            ->setFrom(array($myappContactMail => "Message by ".$username))
            ->setTo(array(
                $myappContactMail => $myappContactMail
            ))
            ->setBody("le message est de la part de l'utilisateur dont l'id est :".$iduser."   Message: ".$data["message"]."   ContactMail :".$mailuser);

        return $mailer->send($message);
    }
}
