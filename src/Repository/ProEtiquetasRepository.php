<?php

namespace App\Repository;

use App\Entity\ProEtiquetas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProEtiquetas>
 *
 * @method ProEtiquetas|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProEtiquetas|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProEtiquetas[]    findAll()
 * @method ProEtiquetas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProEtiquetasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProEtiquetas::class);
    }

//    /**
//     * @return ProEtiquetas[] Returns an array of ProEtiquetas objects
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

//    public function findOneBySomeField($value): ?ProEtiquetas
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
