<?php

namespace App\Repository;

use App\Entity\CatCargos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CatCargos>
 *
 * @method CatCargos|null find($id, $lockMode = null, $lockVersion = null)
 * @method CatCargos|null findOneBy(array $criteria, array $orderBy = null)
 * @method CatCargos[]    findAll()
 * @method CatCargos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CatCargosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CatCargos::class);
    }

//    /**
//     * @return CatCargos[] Returns an array of CatCargos objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CatCargos
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function insertCargo($id,$cargo,$activo)
    {
        $entcargo = $this->findOneByCargo($cargo);
        if($id != 0)
            {
                $entcargo = $this->findOneById($id);
                $entcargo->setCargo($cargo)
                        ->setInactivo($activo);
            }
            elseif($entcargo)
            {
                $entcargo->setCargo($cargo)
                        ->setInactivo($activo)
                        ->setEliminar(false);
            }
            else
            {
                $entcargo = new CatCargos;
                $entcargo->setCargo($cargo)
                        ->setInactivo($activo)
                        ->setEliminar(false);
            }
        return $entcargo;
    }
}
