<?php

namespace App\Controller\Admin;

use App\Entity\CategoriesArticles;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategoriesArticlesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CategoriesArticles::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nameCategoriesArticles'),
        ];
    }
    
}
