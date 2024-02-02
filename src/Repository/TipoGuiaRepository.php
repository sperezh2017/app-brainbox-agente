<?php

namespace App\Repository;

use App\Entity\TipoGuia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TipoGuia>
 *
 * @method TipoGuia|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoGuia|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoGuia[]    findAll()
 * @method TipoGuia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoGuiaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoGuia::class);
    }

//    /**
//     * @return TipoGuia[] Returns an array of TipoGuia objects
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

//    public function findOneBySomeField($value): ?TipoGuia
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function insertGuia($id,$guia,$activo,$listProcesos)
    {
        $entguia = $this->findOneByGuia($guia);
        if($id != 0)
            {
                $entguia = $this->findOneById($id);
                $entguia->setGuia($guia)
                         ->setInactivo($activo);
            }
            elseif($entguia)
            {
                $entguia->setGuia($guia)
                         ->setInactivo($activo)
                         ->setEliminar(false);
            }
            else
            {
                $entguia = new TipoGuia();
                $entguia->setGuia($guia)
                         ->setInactivo($activo)
                         ->setEliminar(0);
            }

            foreach($listProcesos as $protemp)
            {
                $procesotemp = $protemp['proceso'];
                $activo      = $protemp['activo'];
                $entguia->removeProceso($procesotemp);
                if($activo)
                {
                    $entguia->addProceso($procesotemp);
                }
            }

        return $entguia;
    }
}
