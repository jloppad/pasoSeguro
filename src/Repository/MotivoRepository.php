<?php

namespace App\Repository;

use App\Entity\Motivo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Motivo>
 *
 * @method Motivo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Motivo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Motivo[]    findAll()
 * @method Motivo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MotivoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Motivo::class);
    }

//    /**
//     * @return Motivo[] Returns an array of Motivo objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Motivo
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
