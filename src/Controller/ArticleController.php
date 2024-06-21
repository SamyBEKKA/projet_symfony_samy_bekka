<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use DateTime;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends AbstractController
{
    #[Route('/article/{id}', name: "article_item")]
    public function item(Article $article): Response
    {
        // dd($article->getId()); 
        return $this->render('article/unique.html.twig', [
        'article' => $article
    ]);
    }
    #[Route('/new/article', name: 'new_article', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $em, SluggerInterface $slugger): Response
    {
        $article = new Article();

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);
       
       
        if ($form->isSubmitted() && $form->isValid()) {
             
            $images = $form->get('image')->getData();
            $article->setdateArticle(new DateTime());
            $article->setVisibility(true);
            
            if ($images) {
               $originalFilename = pathinfo($images->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $filename = $safeFilename . '-' . uniqid() . '.' . $images->guessExtension();
                try {
                    $this->addFlash('success', 'Article publié');
                $images->move(
                    'uploads/article/',
                    $filename
                );
                 
                $article->setImage($filename);
                    } catch (FileException $e) {
                            $form->addError(new FormError("Une erreur est survenue pendant la création de l'article, merci de bien vouloir relire"));
                        } 
                    $em->persist($article);
                    $em->flush(); 
                    return $this->redirectToRoute('blog/index.html.twig');       
                }  
        }
        return $this->render('article/index.html.twig', [
        'articleForm' => $form,
        'controller_name' => 'Créer vos articles',
        ]);
    }
     
}