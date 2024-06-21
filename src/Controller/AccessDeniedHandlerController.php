<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AccessDeniedHandlerController extends AbstractController
{
    #[Route('/access/denied/handler', name: 'app_access_denied_handler')]
    public function __invoke(Request $request, AccessDeniedException $exception)
    {
        // You can customize the response here
        $content = 'You do not have permission to access this resource.';
        return new Response($content, 403);
    }
    
    
    
    public function index(): Response
    {
        return $this->render('access_denied_handler/index.html.twig', [
            'controller_name' => 'AccessDeniedHandlerController',
        ]);
    }
}
