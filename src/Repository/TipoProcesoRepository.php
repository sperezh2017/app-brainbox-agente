<?php

namespace App\Repository;

use App\Entity\TipoProceso;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TipoProceso>
 *
 * @method TipoProceso|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoProceso|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoProceso[]    findAll()
 * @method TipoProceso[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoProcesoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoProceso::class);
    }

//    /**
//     * @return TipoProceso[] Returns an array of TipoProceso objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TipoProceso
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
