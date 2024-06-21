<?php

namespace App\EventSubscriber;

use App\Event\UserRegisteredEvent;
use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Notifier\Bridge\Discord\DiscordOptions;
use Symfony\Component\Notifier\Bridge\Discord\Embeds\DiscordEmbed;
use Symfony\Component\Notifier\Bridge\Discord\Embeds\DiscordFieldEmbedObject;
use Symfony\Component\Notifier\Bridge\Discord\Embeds\DiscordFooterEmbedObject;
use Symfony\Component\Notifier\Bridge\Discord\Embeds\DiscordMediaEmbedObject;
use Symfony\Component\Notifier\ChatterInterface;
use Symfony\Component\Notifier\Message\ChatMessage;

class UserSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private MailerInterface $mailer,
        private string $adminEmail,
        private ChatterInterface $chatter,
        private Security $security
      ) {
      }
        public function onUserRegistered(UserRegisteredEvent $event): void
            {
            $user = $event->getUser();

            $email = (new Email())
                ->from($this->adminEmail)
                ->to($user->getEmail())
                ->subject("Inscription")
                ->text("Votre compte contenent le mail : " . $user->getEmail() . " a bien été enregistré, merci");

            $this->mailer->send($email);
            }
        public static function getSubscribedEvents(): array
        {
            return [
                'user.registered' => 
                [
                    ['onUserRegistered', 10],
                    ['sendDiscordNotification', 5]
                ],
            ];
        }
        public function sendDiscordNotification(UserRegisteredEvent $event): void
        {
            $user = $event->getUser();
        $chatMessage = new ChatMessage('');

        $discordOptions = (new DiscordOptions())
            ->username('YAAAAAh')
            // Mise en forme de la notification...
            ->addEmbed(
                (new DiscordEmbed())
                ->color(2021216)
                ->title('Nouveau User')
                ->thumbnail((new DiscordMediaEmbedObject())
                ->url('https://ld-web.github.io/hb-sf-pe8-course/img/logo.png'))
                ->addField(
                    (new DiscordFieldEmbedObject())
                    ->name('1234 OK')
                    ->value('[Out of Mind](https://open.spotify.com/track/4tLh6ilwgHAWnkui4hAR3p)')
                    ->inline(true)
                )
                ->addField(
                    (new DiscordFieldEmbedObject())
                    ->name('Email')
                    ->value($user->getEmail())
                    ->inline(true)
                )
                // ->addField(
                //     (new DiscordFieldEmbedObject())
                //     ->name('Artist')
                //     ->value('DIIV')
                //     ->inline(true)
                // )
                ->footer(
                    (new DiscordFooterEmbedObject())
                    ->text('Human Booster - 2023')
                    ->iconUrl('https://ld-web.github.io/hb-sf-pe7-course/img/logo.png')
                )
                );

        $chatMessage->options($discordOptions);
        $this->chatter->send($chatMessage);
        }
}
