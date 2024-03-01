<?php

namespace App\Repository;

use App\Entity\FicheProduit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FicheProduit>
 *
 * @method FicheProduit|null find($id, $lockMode = null, $lockVersion = null)
 * @method FicheProduit|null findOneBy(array $criteria, array $orderBy = null)
 * @method FicheProduit[]    findAll()
 * @method FicheProduit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FicheProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FicheProduit::class);
    }


    public function findBySearchQuery($query)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.titre LIKE :query OR p.description LIKE :query')
            ->setParameter('query', '%' . $query . '%')
            ->getQuery()
            ->getResult();
    }


    
public function findByCategorieNom($categorieNom)
{
    return $this->createQueryBuilder('fp')
        ->join('fp.idCategorie', 'c')
        ->where('c.nom = :categorieNom')
        ->setParameter('categorieNom', $categorieNom)
        ->getQuery()
        ->getResult();
}




//    /**
//     * @return FicheProduit[] Returns an array of FicheProduit objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FicheProduit
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function findAllSortedByCategory()
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT fp
        FROM App\Entity\FicheProduit fp
        JOIN fp.idCategorie c
        ORDER BY c.nom ASC'
        );

        return $query->getResult();
    }

    public function findFirstProductByCategory()
    {
        return $this->createQueryBuilder('fp')
            ->join('fp.idCategorie', 'c')
            ->groupBy('c.id')
            ->getQuery()
            ->getResult();
    }

}
