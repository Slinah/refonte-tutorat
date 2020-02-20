<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContactUsController extends AbstractController
{
    /**
     * @Route("/contactUs", name="contact_us")
     */
    public function index(Request $request,\Swift_Mailer $mailer)
    {
        $form=$this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $message = (new \Swift_Message('Nouveau message'))
                ->setContentType("text/html")
                ->setFrom('scratchoverflow@gmail.com')
                ->setTo(['cedric.menanteau@epsi.fr' => 'Cedric',            #Envoie à la boite mail admin
                         'priscillia.dezettre@ecoles-wis.net' => 'Priscillia'
                ])
                ->setBody(
                    $this->renderView(
                        'contact_us/mail.html.twig', array('data'=>$data)
                    )
                )
            ;
            $mailer->send($message);

            $this->addFlash('success', 'Message envoyé avec succès !');


            return $this->redirectToRoute("home");
        }
        return $this->render('contact_us/index.html.twig',[
            "form"=>$form->createView()
        ]);
    }
}
