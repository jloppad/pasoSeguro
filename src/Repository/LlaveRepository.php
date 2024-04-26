<?php

namespace App\Repository;

use App\Entity\Llave;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Llave>
 *
 * @method Llave|null find($id, $lockMode = null, $lockVersion = null)
 * @method Llave|null findOneBy(array $criteria, array $orderBy = null)
 * @method Llave[]    findAll()
 * @method Llave[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LlaveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Llave::class);
    }

//    /**
//     * @return Llave[] Returns an array of Llave objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Llave
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
