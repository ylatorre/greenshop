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
    return $this->createQueryBuilder('fp')
        ->leftJoin('fp.idCategorie', 'c')
        ->addSelect('c')
        ->orderBy('c.nom', 'ASC') // Vous pouvez changer 'nom' par la propriété que vous souhaitez utiliser pour trier
        ->getQuery()
        ->getResult();
}
}
