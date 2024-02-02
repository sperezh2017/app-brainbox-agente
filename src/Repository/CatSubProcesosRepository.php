<?php

namespace App\Repository;

use App\Entity\CatSubProcesos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CatSubProcesos>
 *
 * @method CatSubProcesos|null find($id, $lockMode = null, $lockVersion = null)
 * @method CatSubProcesos|null findOneBy(array $criteria, array $orderBy = null)
 * @method CatSubProcesos[]    findAll()
 * @method CatSubProcesos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CatSubProcesosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CatSubProcesos::class);
    }

//    /**
//     * @return CatSubProcesos[] Returns an array of CatSubProcesos objects
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

//    public function findOneBySomeField($value): ?CatSubProcesos
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function insertSubProceso($id,$subproceso,$proceso,$activo)
    {
        $subpro = $this->findOneBySubproceso($subproceso);
        if($id != 0)
            {
                $subpro = $this->findOneById($id);
                $subpro->setSubproceso($subproceso)
                        ->setProceso($proceso)
                        ->setInactivo($activo);
            }
            elseif($subpro)
            {
                $subpro->setSubproceso($subproceso)
                        ->setProceso($proceso)
                        ->setInactivo($activo)
                        ->setEliminar(false);
            }
            else
            {
                $subpro = new CatSubProcesos;
                $subpro->setSubproceso($subproceso)
                         ->setProceso($proceso)
                         ->setInactivo($activo)
                         ->setEliminar(false);
            }
        return $subpro;
    }
}
