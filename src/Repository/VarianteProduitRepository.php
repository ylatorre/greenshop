<?php

namespace App\Repository;

use App\Entity\VarianteProduit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VarianteProduit>
 *
 * @method VarianteProduit|null find($id, $lockMode = null, $lockVersion = null)
 * @method VarianteProduit|null findOneBy(array $criteria, array $orderBy = null)
 * @method VarianteProduit[]    findAll()
 * @method VarianteProduit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VarianteProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VarianteProduit::class);
    }

//    /**
//     * @return VarianteProduit[] Returns an array of VarianteProduit objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?VarianteProduit
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
