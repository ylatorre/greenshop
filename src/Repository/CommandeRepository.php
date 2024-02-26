<?php

namespace App\Repository;

use App\Entity\Commande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * @extends ServiceEntityRepository<Commande>
 *
 * @method Commande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commande[]    findAll()
 * @method Commande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commande::class);
    }

    public function findByDateDescending()
{
    return $this->createQueryBuilder('c')
        ->orderBy('c.createdAt', 'DESC')
        ->getQuery()
        ->getResult();
}


public function getCommandesParHeure(): array
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('heure', 'heure');
        $rsm->addScalarResult('total', 'total');

        $query = $this->getEntityManager()->createNativeQuery(
            'SELECT EXTRACT(HOUR FROM c.created_at) as heure, COUNT(*) as total
             FROM commande c
             GROUP BY heure', $rsm);

        return $query->getResult();
    }

    public function getCommandesParMois(): array
{
    $rsm = new ResultSetMapping();
    $rsm->addScalarResult('mois', 'mois');
    $rsm->addScalarResult('total', 'total');

    $query = $this->getEntityManager()->createNativeQuery(
        'SELECT TO_CHAR(c.created_at, \'YYYY-MM\') as mois, COUNT(*) as total
         FROM commande c
         GROUP BY mois
         ORDER BY mois', $rsm);

    return $query->getResult();
}

//    /**
//     * @return Commande[] Returns an array of Commande objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Commande
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
