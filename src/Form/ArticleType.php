<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\categoriesArticles;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameArticle')
            // ->add('dateArticle', null, [
            //     'widget' => 'single_text',
            // ])
            ->add('shortDescriptionArticle')
            ->add('textArticle')
            ->add('image' , FileType::class, [
                'constraints' => [
                    new Image()]
                ])
            ->add('categories', EntityType::class, [
                'class' => categoriesArticles::class,
                'choice_label' => 'nameCategoriesArticles',
                'multiple' => true,
                
            ])
            ->add('Envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
