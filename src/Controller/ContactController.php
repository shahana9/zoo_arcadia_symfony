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
        $contact = new Contact("","","");
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()) {
            $email = (new Email())
                ->from($contact->getEmail())
                ->to('s27ty.test@inbox.testmail.app') 
                ->subject($contact->getTitle())
                ->text($contact->getDescription());

            $mailer->send($email);

            $this->addFlash('success', 'Votre message a été envoyé avec succès !');

            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
       