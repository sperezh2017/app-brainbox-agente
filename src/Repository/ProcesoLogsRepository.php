<?php

namespace App\Repository;

use App\Entity\ProcesoLogs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProcesoLogs>
 *
 * @method ProcesoLogs|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProcesoLogs|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProcesoLogs[]    findAll()
 * @method ProcesoLogs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProcesoLogsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProcesoLogs::class);
    }

//    /**
//     * @return ProcesoLogs[] Returns an array of ProcesoLogs objects
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

//    public function findOneBySomeField($value): ?ProcesoLogs
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function insertProcesoLogs($proceso,$nombproc,$dias,$mes,$recurren,$entidad,$diaant,$activo,$tipo,$variable,$diasemana,$despues,$habilitar,$usuCreate,$usuUpdate,$fechaCreate,$fechaUpdate)
    {
    
            $procesolog = new ProcesoLogs();
            $procesolog->setProdescripcion($nombproc)
                        ->setDia($dias)
                        ->setMes($mes)
                        ->setRecurrencia($recurren)
                        ->setProantdias($diaant)
                        ->setEntidad($entidad)
                        ->setInactivo($activo)
                        ->setEliminar(0)
                        ->setTipoProceso($tipo)
                        ->setVariableInicio($variable)
                        ->setDiasemana($diasemana)
                        ->setDespues($despues)
                        ->setHabFin($habilitar)
                        ->setProceso($proceso)
                        ->setUsuCreate($usuCreate)
                        ->setUsuUpdate($usuUpdate)
                        ->setFechaCreate($fechaCreate)
                        ->setFechaUpdate($fechaUpdate);           
        
        return $procesolog;
    }
}
