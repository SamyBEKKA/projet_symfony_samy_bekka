<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Mail\ContactMail;
use DateTimeImmutable;

// class ContactController extends AbstractController
// {
//     #[Route('/contact', name: 'app_contact')]
//     public function index(): Response
//     {

//         return $this->render('contact/index.html.twig', [
//             'controller_name' => 'ContactController',
//         ]);
//     }
// }
    class ContactController extends AbstractController{
    #[Route('/contact', name: 'contact')]
    public function subscribe(Request $request, EntityManagerInterface $em, ContactMail $contactMail): Response
    {
       

        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact->setDate(new DateTimeImmutable());
            $em->persist($contact);
            $em->flush();

            $contactMail->sendConfirmation($contact);

            $this->addFlash('success', 'Merci, votre email a bien été enregistré');
            return $this->redirectToRoute('contact');
        }

        if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('error', "Une erreur est survenue pendant le traitement du formulaire, merci de bien vouloir relire");
        }

        return $this->render('contact/index.html.twig', [
            'contactForm' => $form,
            // 'controller_name' => 'Contact',
        ]);
    }
}