<?php

namespace App\Repository;

use App\Entity\TipoDocIdent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TipoDocIdent>
 *
 * @method TipoDocIdent|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoDocIdent|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoDocIdent[]    findAll()
 * @method TipoDocIdent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoDocIdentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoDocIdent::class);
    }

//    /**
//     * @return TipoDocIdent[] Returns an array of TipoDocIdent objects
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

//    public function findOneBySomeField($value): ?TipoDocIdent
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function insertTipoDoc($id,$tipodoc,$codsri,$activo)
    {
        $entcargo = $this->findOneByDocumento($tipodoc);
        if($id != 0)
            {
                $entcargo = $this->findOneById($id);
                $entcargo->setDocumento($tipodoc)
                        ->setCodsri($codsri)
                        ->setInactivo($activo);
            }
            elseif($entcargo)
            {
                $entcargo->setDocumento($tipodoc)
                        ->setCodsri($codsri)
                        ->setInactivo($activo)
                        ->setEliminar(false);
            }
            else
            {
                $entcargo = new TipoDocIdent;
                $entcargo->setDocumento($tipodoc)
                        ->setCodsri($codsri)
                        ->setInactivo($activo)
                        ->setEliminar(false);
            }
        return $entcargo;
    }
}
