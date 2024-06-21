<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name'
            // , TextType::class, array(
            //     'pattern' => '[a-zA-Z0-9_-]+',)
            )
            ->add('lastname'
            // , TextType::class, array(
            //     'pattern' => '[a-zA-Z0-9_-]+',)
            )
            ->add('email'
            // , TextType::class, array(
            //     'pattern' => '[a-zA-Z0-9_-]+',)
            )
            ->add('company'
            // ,  TextType::class, array(
            //     'pattern' => '[a-zA-Z0-9_-]+',)
            , 
            null)
            ->add('message'
            // , TextType::class, array(
            //     'pattern' => '[a-zA-Z0-9_-]+',)
            , 
            null)
            ->add('Envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }

}
