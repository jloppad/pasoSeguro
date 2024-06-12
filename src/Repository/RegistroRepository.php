<?php

namespace App\Repository;

use App\Entity\Registro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Registro>
 *
 * @method Registro|null find($id, $lockMode = null, $lockVersion = null)
 * @method Registro|null findOneBy(array $criteria, array $orderBy = null)
 * @method Registro[]    findAll()
 * @method Registro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegistroRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Registro::class);
    }

    public function findAllOut()
    {
        return $this->createQueryBuilder('r')
            ->where('r.horaEntrada is null')
            ->select('r')
            ->orderBy('r.horaSalida')
            ->getQuery()
            ->getResult();
    }

}
