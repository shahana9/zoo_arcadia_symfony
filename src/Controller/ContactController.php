<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function newContact(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $address = $data['email'];
            $title = $data['title'];
            $content = $data['description'];
            $email = (new Email())
                ->to($address)
                ->from('no-reply@zooarcadia.com')
                ->subject($title)
                ->text($content);

            try {
                $mailer->send($email);
                $this->addFlash('success', 'Votre message a été envoyé avec succès !');

                return $this->redirectToRoute('app_contact');
            } catch (\Throwable $th) {
                //throw $th;
                $this->addFlash('error', $th->getMessage() . " : Votre message n'est pas envoyé!");
            }           
        }

        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
            'title' => 'Contact'
        ]);
    }
}
       