<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Articles;
use App\Entity\Categorie;

class ArticlesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        //Créer 3 catégories
        for($i = 1; $i <=3; $i++){
            $categorie = new Categorie();
            $categorie->setTitre($faker->sentence())
                        ->setDescription($faker->paragraph());
            $manager->persist($categorie);
            
            //Créer 5 articles
            for($j = 1; $j <= 5; $j++){
                $articles = new Articles();

                $contenu = '<p>' . join($faker->paragraphs(5), '</p><p>') . '</p>';

                $articles->setTitre($faker->sentence())
                        ->setContenu($contenu)
                        ->setImage("http://placeimg.com/500/300/any/sepia")
                        ->setDateCreation($faker->dateTimeBetween('-6 months'))
                        ->setExtraitContenu($faker->sentence())
                        ->setCategorie($categorie);

                $manager->persist($articles);
            }
        }
        $manager->flush();
    }
}
