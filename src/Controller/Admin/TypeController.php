<?php

namespace App\Controller\Admin;

use App\Entity\Type;
use App\Form\TypeType;
use App\Repository\TypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class TypeController extends AbstractController
{
    #[Route('/admin/type', name: 'admin_types')]
    public function index( TypeRepository $typeRepository): Response
    {   
        $types = $typeRepository->findAll();
        return $this->render('admin/type/admintype.html.twig', [
            'types' => $types,
        ]);
    }


    // route pour ajouter un type 
    #[Route('/admin/type/create', name: 'ajoutType')]
    // route pour la modification d'un type
    #[Route('/admin/type/{id}', name: 'modifTypes', methods: ['POST','GET'])]
    // Request permet de récupérer les informations de la requête HTTP de l'utilisateur
    // EntityManagerInterface permet de gérer les entités de la base de données
    public function ajoutEtModif( Type $type = null, Request $request, EntityManagerInterface $entityManagerInterface): Response
    {   
        // on vérifie si le type existe ou non, si il existe on le modifie sinon on le crée   
        if(!$type){
            $type = new Type();
        }

        // création du formulaire pour l'envoyé au template avec l'objet type  passé en paramètre//
        $form = $this->createForm(TypeType::class, $type);
        // On demande au formulaire d'analyser la requête HTTP de l'utilisateur
        $form->handleRequest($request); 
        // Si le formulaire a été envoyé et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            $modif = $type->getId();
            // On enregistre notre objet $type dans la base de données
            $entityManagerInterface->persist($type);
            $entityManagerInterface->flush();
            if($modif){
                $this->addFlash('success', 'Type modifié avec succès');
                // $this->addFlash('success', 'Le type a bien été modifié');
            }else{
                $this->addFlash('success', 'Le type a bien été ajouté');
            }                        
            // On redirige vers la page de visualisation de l'annonce nouvellement créée
            return $this->redirectToRoute('admin_types');
        }    

        return $this->render('admin/type/ajoutEtModif.html.twig', [
           "type" => $type,
           // on passe la partie affichage du formulaire à la vue //
           "form" => $form->createView(),
           // isModif permet de savoir si on est en modification ou en ajout //
           'isModif' => $type->getId() !== null
        ]);
    }


    // suppression d'un type
    #[Route('/admin/type/{id}', name: 'supprimerType', methods: ['delete'])]
    public function supprimer(Type $type, Request $request, EntityManagerInterface $entityManagerInterface) : Response    
    {   
        if($this->isCsrfTokenValid('delete', $request->get('_token')))
        $entityManagerInterface->remove($type);
        $entityManagerInterface->flush();
        $this->addFlash('success', 'Le type a bien été supprimé');
        return $this->redirectToRoute('admin_types');
    }
}
