<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProduitController extends AbstractController
{   
    #[Route('/produit/{id}', name: "produit_item")]
    public function item(Produit $product): Response
    {
        // dd($article->getId()); 
        return $this->render('produit/unique.html.twig', [
        'produit' => $product
    ]);
    }
    #[Route('/produits', name: 'produits')]
    public function index(ProduitRepository $produitRepository): Response
    {   
        $produit = $produitRepository->findAll();
        // dd($produit);
        return $this->render('produit/index.html.twig', [
            'produit' => $produit,
            'controller_name' => 'Nos produits',
        ]);
    }
}
