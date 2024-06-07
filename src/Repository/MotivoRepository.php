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

    public function findByOrder()
    {
        return $this->createQueryBuilder('m')
            ->orderBy('m.numeroOrden')
            ->getQuery()
            ->getResult();
    }

}
