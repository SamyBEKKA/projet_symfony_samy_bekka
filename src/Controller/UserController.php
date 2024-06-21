<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Event\UserRegisteredEvent;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    #[Route('/user/register', name: 'user_register')]
    public function register(
    Request $request,
    UserRepository $userRepository,
    EventDispatcherInterface $dispatcher,
    EntityManagerInterface $em
    ): Response {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //$userRepository->save($user, true);
            // J'instancie l'événement en lui passant l'entité concernée
            // L'événement portera donc la donnée concernée, exploitable par les listeners/subscribers
            $event = new UserRegisteredEvent($user);
            // Je diffuse l'événement, en précisant son nom
            $dispatcher->dispatch($event, UserRegisteredEvent::NAME);
            $em->persist($user);
            $em->flush();
          }
          return $this->render('user/index.html.twig', [
            'userForm' => $form,
        ]);
    }
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        
        return $this->render('user/index.html.twig', [
            'userForm' => 'user',
        ]);
    }
    
    
}
