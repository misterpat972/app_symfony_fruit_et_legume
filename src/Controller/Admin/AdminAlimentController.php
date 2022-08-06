<?php

namespace App\Controller\Admin;

use App\Entity\Aliment;
use App\Form\AlimentType;
use App\Repository\AlimentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminAlimentController extends AbstractController
{
    #[Route('/admin/aliment', name: 'admin_aliment')]
    public function admin(AlimentRepository $alimentRepository): Response
    {           
        // on récupère la liste des aliments 
        $aliments = $alimentRepository->findAll();        
        return $this->render('admin/admin.html.twig', [
            'aliments' =>  $aliments,
        ]);
    }


    // on crée une nouvelle route pour créer un nouvel aliment
    #[Route('/admin/aliment/creation', name: 'admin_aliment_creation')]
    // on récupère l'aliment avec l'id passé en paramètre, request permet de récuperer les requête, ObjectManager pour la persistant et flush //
    #[Route('/admin/aliment/{id}', name: 'admin_aliment_modification', methods: ['POST','GET'])]
    public function ajoutEtModif( Aliment $aliment = null, Request $request, EntityManagerInterface $entityManagerInterface): Response
    {             
        // si l'aliment est null(n'exite pas), alors on crée un nouvel aliment
        if(!$aliment) {
            $aliment = new Aliment();
        }        
        // ici on crée le formulaire de modification de l'aliment //  
        $form = $this->createForm(AlimentType::class, $aliment);
        // on récupère la requête du formulaire //
        $form->handleRequest($request);
        // on verifie si le formulaire a été soumis et est valide //
        if($form->isSubmitted() && $form->isValid())
        { 
            // on persiste l'aliment modifié //
            $entityManagerInterface->persist($aliment); 
            // on flush pour l'enregistrer dans la base de données //
            $entityManagerInterface->flush(); 
            if($request->get('_route' == 'admin_aliment_modification')) {               
                // message de confirmation //
                $this->addFlash('success', 'Aliment modifié avec succès');
            }else {
                $this->addFlash('success', 'Aliment créé avec succès');
            }
            // redirection vers la page d'accueil grâce à l'élement symfony redirectToRoute
            return $this->redirectToRoute('admin_aliment');
        }

        return $this->render('admin/modificationEtAjoutAliment.html.twig', [
            // on passe l'aliment à modifier à la vue //
            'aliment' => $aliment,
            // on passe à la vue le formulaire de modification de l'aliment //
            'form' => $form->createView(),
            // on vérifie si l'aliment existe  (booléen)//
            'isModif' => $aliment->getId() !== null,
        ]);
    }


    #[Route('/admin/aliment/{id}', name: 'admin_aliment_delete', methods: ['delete'])]
    public function delete(Aliment $aliment, Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        if($this->isCsrfTokenValid('delete', $request->get('_token')))
        {
            // avec l'enttity manager on peut supprimer l'aliment //
            $entityManagerInterface->remove($aliment);
            // on flush pour l'enregistrer dans la base de données //
            $entityManagerInterface->flush();
            // redirection vers la page d'accueil grâce à l'élement symfony redirectToRoute            
            $this->addFlash('success', 'Aliment supprimé avec succès');
        }        
        return $this->redirectToRoute('admin_aliment');       
    }
}
