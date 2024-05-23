<?php

namespace App\Repository;

use App\Entity\ProEstados;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProEstados>
 *
 * @method ProEstados|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProEstados|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProEstados[]    findAll()
 * @method ProEstados[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProEstadosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProEstados::class);
    }

//    /**
//     * @return ProEstados[] Returns an array of ProEstados objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ProEstados
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
