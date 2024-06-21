<?php

namespace App\Mail;

use App\Entity\Contact;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Controller\ContactController;

class ContactMail
{

    public function __construct(
        private MailerInterface $mailer,
        private string $adminEmail
    ){   
    }

    public function sendConfirmation(Contact $contactMail) : void
    {
        $email = (new Email())
            ->from($this->adminEmail)
            ->to($contactMail->getEmail())
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Message contact')
            ->text('Mail réussi')
            ->html('<p>Message de : ' . $contactMail->getEmail() .
            '<br>Prénom : ' . $contactMail->getName() .
            '<br>Nom : ' . $contactMail->getLastname() . 
            '<br>Company (null) : ' . $contactMail->getCompany() . 
            '<br>Message : ' . $contactMail->getMessage() . '</p>'
            );

        $this->mailer->send($email);
    }
}