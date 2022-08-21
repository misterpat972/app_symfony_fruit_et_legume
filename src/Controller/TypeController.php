<?php

namespace App\Controller;

use App\Repository\TypeRepository;
use Doctrine\DBAL\Types\TypeRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TypeController extends AbstractController
{
    #[Route('/types', name: 'type')]
    public function index( TypeRepository $typeRepository): Response
    {
        $types = $typeRepository->findAll();
       
        return $this->render('type/types.html.twig', [
            'types' => $types,
        ]);
    }
}
