<?php

namespace App\Repository;

use App\Entity\CatProceso;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CatProceso>
 *
 * @method CatProceso|null find($id, $lockMode = null, $lockVersion = null)
 * @method CatProceso|null findOneBy(array $criteria, array $orderBy = null)
 * @method CatProceso[]    findAll()
 * @method CatProceso[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CatProcesoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CatProceso::class);
    }

//    /**
//     * @return CatProceso[] Returns an array of CatProceso objects
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

//    public function findOneBySomeField($value): ?CatProceso
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

  public function insertProceso($nuevo,$proceso,$nombproc,$dias,$mes,$recurren,$entidad,$diaant,$activo,$tipo,$variable,$diasemana,$despues,$habilitar)
  {
    if(empty($proceso))
    {
      $proceso = $this->findOneByProdescripcion($nombproc);
    }
    if($nuevo == 0 and $proceso)
          {
            $proceso->setProdescripcion($nombproc)
                    ->setDia($dias)
                    ->setMes($mes)
                    ->setRecurrencia($recurren)
                    ->setProantdias($diaant)
                    ->setEntidad($entidad)
                    ->setInactivo($activo)
                    ->setTipoProceso($tipo)
                    ->setVariableInicio($variable)
                    ->setDiasemana($diasemana)
                    ->setDespues($despues)
                    ->setHabFin($habilitar);
          }
          elseif($nuevo == 1 and empty($proceso))
          {
            $proceso = new CatProceso();
            $proceso->setProdescripcion($nombproc)
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
                    ->setHabFin($habilitar);
          }
          elseif($nuevo == 1 and $proceso)
          {
            $proceso->setProdescripcion($nombproc)
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
                    ->setHabFin($habilitar);
          }
        
       return $proceso;
  }

  public function ultimoRegistro()
  {
    $query = $this->createQueryBuilder('i');
        $query->select('i')
              ->orderBy('i.id', 'desc')
              ->setMaxResults(1);

        $result = $query->getQuery()->getResult();

        return $result;
  }

}
