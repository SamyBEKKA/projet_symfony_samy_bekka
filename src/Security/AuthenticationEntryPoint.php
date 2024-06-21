<?php
namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;

    class AuthenticationEntryPoint implements AuthenticationEntryPointInterface
    {
        public function __construct(
            private UrlGeneratorInterface $urlGenerator,
        ) {
        }

        //#[Route(path: '/login/denied', name: 'app_login_denied')]
        public function start(Request $request, ?AuthenticationException $authException = null): RedirectResponse
        {
            // add a custom flash message and redirect to the login page
            // $request->getSession()->getFlashBag()->add('Accès non autorisé vous devez vous connectez à partir d un autre compte');

            return new RedirectResponse($this->urlGenerator->generate('login'));
        }
    }