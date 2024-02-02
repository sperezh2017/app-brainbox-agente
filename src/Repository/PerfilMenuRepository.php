<?php

namespace App\Repository;

use App\Entity\PerfilMenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PerfilMenu>
 *
 * @method PerfilMenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method PerfilMenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method PerfilMenu[]    findAll()
 * @method PerfilMenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PerfilMenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PerfilMenu::class);
    }

//    /**
//     * @return PerfilMenu[] Returns an array of PerfilMenu objects
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

//    public function findOneBySomeField($value): ?PerfilMenu
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
