<?php

namespace App\Repository;

use App\Entity\Aliment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Aliment>
 *
 * @method Aliment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Aliment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Aliment[]    findAll()
 * @method Aliment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlimentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Aliment::class);
    }

    public function add(Aliment $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Aliment $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }



    // // fonction créer dans le répositorie pour récupérer les aliments avec moins de 50 calories //
    // public function getAlimentParCalorie($calorie)
    // {   
    //     // ici on génère la requête SQL pour récupérer les aliments dans notre table aliments (SELECT * FROM)//
    //     return $this->createQueryBuilder('a') // (a) est le nom de la table aliments //
    //         ->andWhere('a.calories <= :calorie') // a.calorie est la colonne de la table aliments qui correspond au nombre de calories (WHERE calorie <=) //
    //         ->setParameter('calorie', $calorie) // on lie le paramètre de fonction à la variable pour éviter les injections SQL  //
    //         // ->orderBy('a.calorie', 'ASC') // on trie les aliments par leur nombre de calories croissant (ORDER BY calorie ASC) //
    //         ->getQuery() // on récupère la requête SQL générée (FETCH) //
    //         ->getResult() // on récupère les résultats de la requête SQL dans (Result) //
    //     ;
    // }

    // fonction créer dans le répositorie pour récupérer les aliments avec moins de 50 calories //
    public function getAlimentParPropriété($propriete, $signe, $calorie)
    {   
        // ici on génère la requête SQL pour récupérer les aliments dans notre table aliments (SELECT * FROM)//
        return $this->createQueryBuilder('a') // (a) est le nom de la table aliments //
            ->andWhere('a.'.$propriete. ' '.$signe. ' :calorie') // a.calorie est la colonne de la table aliments qui correspond au nombre de calories (WHERE calorie <=) //
            ->setParameter('calorie', $calorie) // on lie le paramètre de fonction à la variable pour éviter les injections SQL  //
            // ->orderBy('a.calorie', 'ASC') // on trie les aliments par leur nombre de calories croissant (ORDER BY calorie ASC) //
            ->getQuery() // on récupère la requête SQL générée (FETCH) //
            ->getResult() // on récupère les résultats de la requête SQL dans (Result) //
        ;
    }
    
    // fonction créer dans le répositorie pour récupérer les aliments avec moins de 50 calories //
    public function getAlimentsMinAndMaxCalorie(): array
    {
        return $this->createQueryBuilder('a')
            ->select('MIN(a.calories) AS min, MAX(a.calories) AS max')
            ->getQuery()
            ->getResult();
    }

    // fonction qui permet de suprimer un aliment //
    public function deleteAliment(Aliment $aliment): void
    {
        $this->getEntityManager()->remove($aliment);
        $this->getEntityManager()->flush();
    }
    
//    /**
//     * @return Aliment[] Returns an array of Aliment objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Aliment
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
