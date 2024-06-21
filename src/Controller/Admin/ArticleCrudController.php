<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            DateField::new('dateArticle'),
            TextField::new('nameArticle'),
            TextEditorField::new('shortDescriptionArticle'),
            TextEditorField::new('textArticle'),
            //TextField::new('CategoriesArticles.nameCategoriesArticles'),
            //AssociationField::new('CategoriesArticles.nameCategoriesArticles'),
            ImageField::new('image')->setUploadDir("public/uploads/article")->setBasePath("/uploads/article"),
            BooleanField::new('visibility'),
            
        ];
    }
}
