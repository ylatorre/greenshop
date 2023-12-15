<?php

namespace App\Repository;

use App\Entity\RepAvis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RepAvis>
 *
 * @method RepAvis|null find($id, $lockMode = null, $lockVersion = null)
 * @method RepAvis|null findOneBy(array $criteria, array $orderBy = null)
 * @method RepAvis[]    findAll()
 * @method RepAvis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RepAvisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RepAvis::class);
    }

//    /**
//     * @return RepAvis[] Returns an array of RepAvis objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RepAvis
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
