<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\CategorieProduit;
use App\Entity\CategoriesArticles;
use App\Entity\Contact;
use App\Entity\ImgProduit;
use App\Entity\Produit;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(ArticleCrudController::class)->generateUrl());
        

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        //return $this->render('some/path/my-dashboard.html.twig');
    }
    // #[Route('/accueil', name: 'index')]
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Projet Symfo');
            
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Front', 'fa fa-home', 'index');
        yield MenuItem::linkToCrud('Article', 'fas fa-list', Article::class);
        yield MenuItem::linkToCrud('Catégories Article', 'fas fa-tags', CategoriesArticles::class);
        yield MenuItem::linkToCrud('User', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('Produit', 'fas fa-list', Produit::class);
        yield MenuItem::linkToCrud('Images des Produits', 'fas fa-list', ImgProduit::class);
        yield MenuItem::linkToCrud('Categories Produits', 'fas fa-tags', CategorieProduit::class);
        yield MenuItem::linkToCrud('Contact', 'fas fa-comments', Contact::class);
    }
}
