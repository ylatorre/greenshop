<?php

namespace App\Repository;

use App\Entity\EcoScore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EcoScore>
 *
 * @method EcoScore|null find($id, $lockMode = null, $lockVersion = null)
 * @method EcoScore|null findOneBy(array $criteria, array $orderBy = null)
 * @method EcoScore[]    findAll()
 * @method EcoScore[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EcoScoreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EcoScore::class);
    }

//    /**
//     * @return EcoScore[] Returns an array of EcoScore objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?EcoScore
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
