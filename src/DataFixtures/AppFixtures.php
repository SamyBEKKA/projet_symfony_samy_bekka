<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Contact;
use App\Entity\Produit;
use App\Entity\User;
use DateTime;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private const NB_ARTICLES = 5;
    //private const CATEGORIES = [];
    //J'ai eu des soucie avec les categories
    // public function __construct(
    //     private UserPasswordHasherInterface $hasher
    // ) {
    // }
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        // for ($i = 0; $i < self::NB_ARTICLES; $i++) {
        //     $article = new Article();
        //     $article
        //         ->setNameArticle($faker->realText(10, 40))
        //         ->setdateArticle($faker->dateTimeBetween())
        //         ->setShortDescriptionArticle($faker->realTextBetween(1, 80))
        //         ->setTextArticle($faker->realTextBetween(1 , 100))
        //         //->setImage('https://unsplash.com/fr/photos/voitures-voyageant-BnWDqUCWQDU')
        //         ->setVisibility($faker->boolean(0, 1));
        //         //->setCategory($faker->randomElement($categories))
        //         // categorie de coter

        //     $manager->persist($article);
        // }
        // for ($i = 0; $i < 5; $i++) {
        //     $product = new Produit();
        //     $product
        //         ->setNameProduct($faker->realText(5, 20))
        //         ->setPrice($faker->randomNumber(1, 50) . '€')
        //         ->setQuantity($faker->randomNumber(1, 80))
        //         ->setStock($faker->boolean(0, 1))
        //         ->setShortDescription($faker->realTextBetween(1, 80))
        //         ->setLongDescription($faker->realTextBetween(1, 150));

        //         //->setCategory($faker->randomElement($categories))
        //         // categorie de coter

        //     $manager->persist($product);
        // }
        $user = new User();
        $user
            ->setEmail("user@test.com")
            ->setPassword("user1234");

        $manager->persist($user);

        $user = new User();
        $user
            ->setEmail("lucas@lucas.com")
            ->setRoles(["ROLE_LUCAS"])
            ->setPassword("lucas");
           //Accès au site caché

        $manager->persist($user);

        $admin = new User();

        $admin
            ->setEmail("admin@test.com")
            ->setRoles(["ROLE_ADMIN"])
            ->setPassword("admin1234");

        $manager->persist($admin);

        $manager->flush();

    }
}
