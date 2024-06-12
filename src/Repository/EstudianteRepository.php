<?php

namespace App\Repository;

use App\Entity\Estudiante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Estudiante>
 *
 * @method Estudiante|null find($id, $lockMode = null, $lockVersion = null)
 * @method Estudiante|null findOneBy(array $criteria, array $orderBy = null)
 * @method Estudiante[]    findAll()
 * @method Estudiante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstudianteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Estudiante::class);
    }


}
