<?php

namespace App\DataFixtures;

use App\Entity\Aliment;
use App\Entity\Type;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {   
        $type1 = new Type();
        $type1->setLibelle('Fruits');
        $type1->setImage('fruits.jpg');
        $manager->persist($type1);
        

        $type2 = new Type();
        $type2->setLibelle('Légumes');
        $type2->setImage('legumes.jpg');
        $manager->persist($type2);
       

        // récupération du répository de l'entité Aliment//
        $alimentRepository = $manager->getRepository(Aliment::class);
        // récupération de l'aliment dont le nom est 'Pomme' //
        $aliment1 = $alimentRepository->findOneBy(['nom' => 'Pomme']);
        // ajout de l'aliment au type 1 //
        $aliment1->setType($type1);
        // persistance de l'aliment //
        $manager->persist($aliment1);

        // récupération de l'aliment dont le nom est 'Carotte' //
        $aliment2 = $alimentRepository->findOneBy(['nom' => 'Carotte']);
        // ajout de l'aliment au type 2 //
        $aliment2->setType($type2);
        // persistance de l'aliment //
        $manager->persist($aliment2);


        // récupération de l'aliment dont le nom est 'Patate' //
        $aliment3 = $alimentRepository->findOneBy(['nom' => 'Patate']);
        // ajout de l'aliment au type 2 //
        $aliment3->setType($type2);
        // persistance de l'aliment //
        $manager->persist($aliment3);

        // récupération de l'aliment dont le nom est 'Tomate' //
        $aliment4 = $alimentRepository->findOneBy(['nom' => 'Tomate']);
        // ajout de l'aliment au type 2 //
        $aliment4->setType($type2);
        // persistance de l'aliment //
        $manager->persist($aliment4);

        // on enregistre les modifications dans la base de données //
        $manager->flush();
    }
}
