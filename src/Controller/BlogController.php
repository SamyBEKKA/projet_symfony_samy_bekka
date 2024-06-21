<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'blog')]
    public function index(ArticleRepository $articleRepository): Response
    {
        $blog = $articleRepository->findAll();
        // dd($blog);
        return $this->render('blog/index.html.twig', [
            'blog' => $blog,
            'controller_name' => 'Nos articles',
        ]);
    }
}
