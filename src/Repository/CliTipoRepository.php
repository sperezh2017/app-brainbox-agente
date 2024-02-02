<?php

namespace App\Repository;

use App\Entity\CliTipo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CliTipo>
 *
 * @method CliTipo|null find($id, $lockMode = null, $lockVersion = null)
 * @method CliTipo|null findOneBy(array $criteria, array $orderBy = null)
 * @method CliTipo[]    findAll()
 * @method CliTipo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CliTipoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CliTipo::class);
    }

//    /**
//     * @return CliTipo[] Returns an array of CliTipo objects
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

//    public function findOneBySomeField($value): ?CliTipo
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function insertCliTipo($id,$tipo,$activo)
    {
        $entcargo = $this->findOneByTipo($tipo);
        if($id != 0)
            {
                $entcargo = $this->findOneById($id);
                $entcargo->setTipo($tipo)
                        ->setInactivo($activo);
            }
            elseif($entcargo)
            {
                $entcargo->setTipo($tipo)
                        ->setInactivo($activo)
                        ->setEliminar(false);
            }
            else
            {
                $entcargo = new CliTipo;
                $entcargo->setTipo($tipo)
                        ->setInactivo($activo)
                        ->setEliminar(false);
            }
        return $entcargo;
    }
}
