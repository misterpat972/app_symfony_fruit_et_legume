<?php

namespace App\DataFixtures;

use App\Entity\Aliment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        // // nouveau jeux de données dans la base de données concernant les Aliments
        // $aliment = new Aliment();
        // $aliment->setNom('Pomme');
        // $aliment->setPrix(1.2);
        // $aliment->setImage('aliments/pomme.jpg');
        // $aliment->setCalories(1);
        // $aliment->setProteine(0.1);
        // $aliment->setGlucide(0.1);
        // $aliment->setLipide(0.1);
        // // on persiste l'aliment dans la base de données
        // $manager->persist($aliment);


        // $aliment2 = new Aliment();
        // $aliment2->setNom('Carotte');
        // $aliment2->setPrix(1.80);
        // $aliment2->setImage('aliments/carotte.jpg');
        // $aliment2->setCalories(36);
        // $aliment2->setProteine(0.77);
        // $aliment2->setGlucide(6.45);
        // $aliment2->setLipide(0.1);
        // // on persiste l'aliment dans la base de données
        // $manager->persist($aliment2);

        // $aliment3 = new Aliment();
        // $aliment3->setNom('Patate');
        // $aliment3->setPrix(2.80);
        // $aliment3->setImage('aliments/patate.jpg');
        // $aliment3->setCalories(60);
        // $aliment3->setProteine(1.77);
        // $aliment3->setGlucide(10.45);
        // $aliment3->setLipide(0.10);
        // // on persiste l'aliment dans la base de données
        // $manager->persist($aliment3);

        // $aliment4 = new Aliment();
        // $aliment4->setNom('Tomate');
        // $aliment4->setPrix(1.80);
        // $aliment4->setImage('aliments/tomate.jpg');
        // $aliment4->setCalories(20);
        // $aliment4->setProteine(0.80);
        // $aliment4->setGlucide(1.20);
        // $aliment4->setLipide(0.1);
        // // on persiste l'aliment dans la base de données
        // $manager->persist($aliment4);

        
        
        // // $product = new Product();
        // // $manager->persist($product);

        // $manager->flush();
    }
}
