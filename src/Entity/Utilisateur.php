<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
// on importe le repository pour pouvoir configurer la requête de recherche
use App\Repository\UtilisateurRepository;
// on excerce une contrainte de validation sur la classe Utilisateur
use Symfony\Component\Validator\Constraints as Assert;
// représente les rôles de l'utilisateur
use Symfony\Component\Security\Core\User\UserInterface;
// permet d'avoir une entité qui est unique dans la base de données
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
// on importe la classe UserPasswordHasherInterface pour pouvoir hasher le mot de passe
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;


#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
// on va veuiller à ce que le username soit unique
#[UniqueEntity(fields: ['username'], message: 'Ce nom d\'utilisateur est déjà pris')]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    // on ajoute une contrainte de validation pour le nom d'utilisateur
    #[Assert\Length(min: 5, max: 10, minMessage: "Le nom d'utilisateur doit faire au moins 5 caractères", maxMessage: "Le nom d'utilisateur doit faire au plus 10 caractères")]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    // on ajoute une contrainte de validation pour le mot de passe
    #[Assert\Length(min: 5, max: 10, minMessage: "Le mot de  passe doit faire au moins 5 caractères", maxMessage: "Le mot de  passe doit faire au plus 10 caractères")]
    private ?string $password = null;

    // on ajoute une contrainte pour le mot de passe
    #[Assert\Length(min: 5, max: 10, minMessage: "Le mot de  passe doit faire au moins 5 caractères", maxMessage: "Le mot de  passe doit faire au plus 10 caractères")]
    // on ajoute EqualsTo pour vérifier que le mot de passe et la confirmation sont identiques
    #[Assert\EqualTo(propertyPath: "password", message: "Les mots de passe ne correspondent pas")]
    // ajout du verifPassword qui n'est pas dans la BDD
    private ?string $verificationPassword = null;

    #[ORM\Column(length: 255)]
    private ?string $roles = null;


    // rôle de l'utilisateur
    // #[ORM\Column(type: 'json')]
    // private $roles = []; 
    
    public function getRoles(): array
    {
        return [$this->roles];
        // guarantee every user at least has ROLE_USER
        // $roles[] = 'ROLE_USER';    
    }


    /**
     * @see UserInterface
     */
    public function setRoles(?string $roles): self
    {
        if ($roles === null) {
            $this->roles = 'ROLE_USER';
        }else {
            $this->roles = $roles;
        }
             
        return $this;
    }
// fin du role

    /**
     * The public representation of the user (e.g. a username, an email address, etc.)
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

     /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getVerificationPassword(): ?string
    {
        return $this->verificationPassword;
    }

    public function setVerificationPassword(string $verificationPassword): self
    {
        $this->verificationPassword = $verificationPassword;

        return $this;
    }
}
