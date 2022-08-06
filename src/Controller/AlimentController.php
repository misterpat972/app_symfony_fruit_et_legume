<?php

namespace App\Controller;

use App\Repository\AlimentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlimentController extends AbstractController
{   
    // route accueil //
    #[Route('/', name: 'aliments')]
    public function aliments(AlimentRepository $alimentRepository): Response
    {
        // on récupère les aliments entre min et max céer grâce la fonction getAlimentsMinAndMaxCalorie //
        $alimentMinAndMaxCalorie = $alimentRepository->getAlimentsMinAndMaxCalorie();
        // fontion findAll() qui retourne la liste des aliments
        $aliment = $alimentRepository->findAll();
        return $this->render('aliment/aliments.html.twig', [
            'aliments' => $aliment,
            // affiche les calories min et max de la liste des aliments //
            'alimentMinAndMaxCalorie' => $alimentMinAndMaxCalorie,
            // is est en général utiilisé pour les booléens ici elle est (false) //
            'isCalorie' => false,
            'isGlucide' => false,
        ]);
    }


    // ici  on va rechercher les aliments par leur nombre de calories //
    #[Route('/alimentsParCalorie/calorie/{calorie}', name: 'alimentsParCalorie')]
    // dans les parametres de fonction on va rechercher les aliments par leur nombre de calories en récupérant la variable calories //
    public function alimentsParCalorie(AlimentRepository $alimentRepository, $calorie): Response
    {
        // ici on va récupérer les aliments par leur nombre de calories grâce à la fonction créer dans le répositorie //   
        $aliment = $alimentRepository->getAlimentParPropriété('calories', '<', $calorie);
        return $this->render('aliment/alimentsParCalorie.html.twig', [
            'aliments' => $aliment,
            // (is) est en général utiilisé pour les booléens ici elle est (true) //
            'isCalorie' => true,
            'isGlucide' => false,
        ]);
    }

    // ici  on va rechercher les aliments par leur nombre de calories //
    #[Route('/alimentsParGlucide/glucide/{glucide}', name: 'alimentsParGlucide')]
    // dans les parametres de fonction on va rechercher les aliments par leur nombre de calories en récupérant la variable calories //
    public function alimentsAvecMoinsDeGlucide(AlimentRepository $alimentRepository, $glucide): Response
    {
        // ici on va récupérer les aliments par leur nombre de calories grâce à la fonction créer dans le répositorie //   
        $aliment = $alimentRepository->getAlimentParPropriété('glucide', '<', $glucide);
        return $this->render('aliment/alimentsParCalorie.html.twig', [
            'aliments' => $aliment,
            // (is) est en général utiilisé pour les booléens ici elle est (true) //
            'isCalorie' => false,
            'isGlucide' => true,
        ]);
    }




    
   
}
