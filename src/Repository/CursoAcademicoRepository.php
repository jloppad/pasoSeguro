<?php

namespace App\Repository;

use App\Entity\CursoAcademico;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CursoAcademico>
 *
 * @method CursoAcademico|null find($id, $lockMode = null, $lockVersion = null)
 * @method CursoAcademico|null findOneBy(array $criteria, array $orderBy = null)
 * @method CursoAcademico[]    findAll()
 * @method CursoAcademico[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CursoAcademicoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CursoAcademico::class);
    }

//    /**
//     * @return CursoAcademico[] Returns an array of CursoAcademico objects
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

//    public function findOneBySomeField($value): ?CursoAcademico
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
