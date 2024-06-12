<?php

namespace App\Repository;

use App\Entity\Grupo;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Grupo>
 *
 * @method Grupo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Grupo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Grupo[]    findAll()
 * @method Grupo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GrupoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Grupo::class);
    }

    private function getCurrentAcademicYear(): array
    {
        $currentDate = new DateTime();
        $currentYear = (int)$currentDate->format('Y');
        $currentMonth = (int)$currentDate->format('m');

        if ($currentMonth >= 1 && $currentMonth <= 8) {
            $startYear = $currentYear - 1;
            $endYear = $currentYear;
        } else {
            $startYear = $currentYear;
            $endYear = $currentYear + 1;
        }

        return [
            'startDate' => new DateTime("$startYear-09-01"),
            'endDate' => new DateTime("$endYear-08-31"),
        ];
    }

    public function findByDocente($docenteId)
    {
        $currentAcademicYear = $this->getCurrentAcademicYear();

        return $this->createQueryBuilder('g')
            ->innerJoin('g.docentes', 'd')
            ->innerJoin('g.cursoAcademico', 'c')
            ->where('d.id = :docenteId')
            ->andWhere('c.fechaInicio >= :startDate')
            ->andWhere('c.fechaFinal <= :endDate')
            ->setParameter('docenteId', $docenteId)
            ->setParameter('startDate', $currentAcademicYear['startDate'])
            ->setParameter('endDate', $currentAcademicYear['endDate'])
            ->getQuery()
            ->getResult();
    }

    public function findEstudiantesByGrupo($grupoId)
    {
        return $this->createQueryBuilder('g')
            ->innerJoin('g.estudiantes', 'e')
            ->where('g.id = :grupoId')
            ->setParameter('grupoId', $grupoId)
            ->select('e.id, e.nombre, e.apellidos, e.nie, e.foto')
            ->orderBy('e.apellidos')
            ->getQuery()
            ->getResult();
    }


    public function findByCurrentYear()
    {
        $currentAcademicYear = $this->getCurrentAcademicYear();

        return $this->createQueryBuilder('g')
            ->innerJoin('g.cursoAcademico', 'c')
            ->where('c.fechaInicio >= :startDate')
            ->andWhere('c.fechaFinal <= :endDate')
            ->setParameter('startDate', $currentAcademicYear['startDate'])
            ->setParameter('endDate', $currentAcademicYear['endDate'])
            ->getQuery()
            ->getResult();
    }

}
