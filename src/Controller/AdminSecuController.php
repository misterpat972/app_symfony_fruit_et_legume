<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminSecuController extends AbstractController
{
    #[Route('/inscription', name: 'inscription')]
    public function index(Request $request, EntityManagerInterface $entityManagerInterface, UserPasswordHasherInterface $userPasswordHasherInterface ): Response
    {       
        // on instancie un nouvel utilisateur et on le passe au formulaire
        $utilisateur = new Utilisateur();
        // on va générer un formulaire d'inscription pour la passer à la vue
        $form = $this->createForm(InscriptionType::class, $utilisateur);        
        // on récupère les données du formulaire
        $form->handleRequest($request);
        // si le formulaire est soumis et valide
        if($form->isSubmitted() && $form->isValid()){
            // on récupère le mot de passe
            $passwordCrypte = $userPasswordHasherInterface->hashPassword($utilisateur, $utilisateur->getPassword());
            $utilisateur->setPassword($passwordCrypte);
            $entityManagerInterface->persist($utilisateur);
            $entityManagerInterface->flush();
            return $this->redirectToRoute('aliments');
        }

        return $this->render('admin_secu/inscription.html.twig', [
            // on passe le formulaire généré à la vue
            'form' => $form->createView(),
        ]);         
       
    }

    // création de la route pour la connexion
    #[Route('/login', name: 'connexion')]
    // l'injection de dépendance permet d'instancier la classe AuthenticationUtils et de récupérer les erreurs de connexion
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('admin_secu/login.html.twig', [
            // on récupère le message d'erreur    
            'lastUserName' => $authenticationUtils->getLastUsername(),            
            'error' => $authenticationUtils->getLastAuthenticationError(),
        ]);       
    }

    // création pour une route pour la déconnexion
    #[Route('/deconnexion', name: 'deconnexion')]
    public function deconnexion()
    {
        
    }
}
