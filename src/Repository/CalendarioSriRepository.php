<?php

namespace App\Repository;

use App\Entity\CalendarioSri;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CalendarioSri>
 *
 * @method CalendarioSri|null find($id, $lockMode = null, $lockVersion = null)
 * @method CalendarioSri|null findOneBy(array $criteria, array $orderBy = null)
 * @method CalendarioSri[]    findAll()
 * @method CalendarioSri[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CalendarioSriRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CalendarioSri::class);
    }

//    /**
//     * @return CalendarioSri[] Returns an array of CalendarioSri objects
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

//    public function findOneBySomeField($value): ?CalendarioSri
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function insertCalendario($digito,$dia,$mes,$categoria)
    {
        $calendario = $this->findOneBy(array('digito' => $digito,'catCalendario' => $categoria));
        
        if($calendario)
        {
            $calendario->setDigito($digito)
                        ->setDia($dia)
                        ->setMes($mes)
                        ->setCatCalendario($categoria)
                        ->setEliminar(false);
        }
        else
        {
            $calendario = new CalendarioSri;
            $calendario->setDigito($digito)
                        ->setDia($dia)
                        ->setMes($mes)
                        ->setCatCalendario($categoria)
                        ->setEliminar(false); 
        }
        
        return $calendario;
    }
}
