<?php

namespace App\Repository;

use App\Entity\EstadoTarea;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EstadoTarea>
 *
 * @method EstadoTarea|null find($id, $lockMode = null, $lockVersion = null)
 * @method EstadoTarea|null findOneBy(array $criteria, array $orderBy = null)
 * @method EstadoTarea[]    findAll()
 * @method EstadoTarea[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstadoTareaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EstadoTarea::class);
    }

//    /**
//     * @return EstadoTarea[] Returns an array of EstadoTarea objects
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

//    public function findOneBySomeField($value): ?EstadoTarea
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
