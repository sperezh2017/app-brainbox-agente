<?php

namespace App\Repository;

use App\Entity\EstFechaVencimiento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EstFechaVencimiento>
 *
 * @method EstFechaVencimiento|null find($id, $lockMode = null, $lockVersion = null)
 * @method EstFechaVencimiento|null findOneBy(array $criteria, array $orderBy = null)
 * @method EstFechaVencimiento[]    findAll()
 * @method EstFechaVencimiento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstFechaVencimientoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EstFechaVencimiento::class);
    }

//    /**
//     * @return EstFechaVencimiento[] Returns an array of EstFechaVencimiento objects
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

//    public function findOneBySomeField($value): ?EstFechaVencimiento
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
