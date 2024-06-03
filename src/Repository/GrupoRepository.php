<?php

namespace App\Repository;

use App\Entity\Grupo;
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

    public function findEstudiantesByGrupo($grupoId)
    {
        $em = $this->getEntityManager();

        // Subconsulta para obtener el último curso académico añadido
        $subQuery = $em->createQueryBuilder()
            ->select('c.id')
            ->from('App\Entity\CursoAcademico', 'c')
            ->orderBy('c.fechaFinal', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getSingleScalarResult();

        // Consulta principal
        return $this->createQueryBuilder('g')
            ->innerJoin('g.estudiantes', 'e')
            ->where('g.id = :grupoId')
            ->andWhere('g.cursoAcademico = :cursoAcademicoId')
            ->setParameter('grupoId', $grupoId)
            ->setParameter('cursoAcademicoId', $subQuery)
            ->select('e.id, e.nombre, e.apellidos, e.nie, e.foto')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Grupo[] Returns an array of Grupo objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Grupo
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
