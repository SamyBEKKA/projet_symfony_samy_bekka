<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SecretController extends AbstractController
{
    public function __construct(
        private Security $security
    )
    {
        
    }

    #[Route('/thafe-ïn', name: 'thafe_in')]
    public function index(): Response
    {
        // if(no $this->security->isGranted()){
        //     return $this->redirectToRoute('logout');
        // }
        return $this->render('secret/index.html.twig', [
            'controller_name' => 'Secret accueil',
        ]);
    }
}
