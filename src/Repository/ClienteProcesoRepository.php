<?php

namespace App\Repository;

use App\Entity\ClienteProceso;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ClienteProceso>
 *
 * @method ClienteProceso|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClienteProceso|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClienteProceso[]    findAll()
 * @method ClienteProceso[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClienteProcesoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClienteProceso::class);
    }

//    /**
//     * @return ClienteProceso[] Returns an array of ClienteProceso objects
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

//    public function findOneBySomeField($value): ?ClienteProceso
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function insertProcesoCliente($cliente,$proceso,$mes,$dias,$diasant,$fechaeje,$tipguia,$familia,$variable,$aplicdig,$aplicfec,$aplicvez,$aplicdesp,$apartir)
    {
        $cliproceso = new ClienteProceso();
        $cliproceso->setCliente($cliente)
                    ->setProceso($proceso)
                    ->setDia($dias)
                    ->setProantdias($diasant)
                    ->setAplicdig($aplicdig)
                    ->setAplicfec($aplicfec)
                    ->setAplicvez($aplicvez)
                    ->setAplicdesp($aplicdesp)
                    ->setApartir($apartir);
        if($mes)
        {
            $cliproceso->setMes($mes);
        }
        /*if($contacto)
        {
            $cliproceso->setContacto($contacto);
        }*/
        if($fechaeje)
        {
            $cliproceso->setFechaeje($fechaeje);
        }
        if($tipguia)
        {
            $cliproceso->setGuia($tipguia);
        }
        if($familia)
        {
            $cliproceso->setFamilia($familia);
        }
        if($variable)
        {
            $cliproceso->setVariable($variable);
        }

        return $cliproceso;
    }

    public function buscarProcesosClientes($cliente): array
    {
        
        $query = $this->createQueryBuilder('c');
        $query->andWhere('c.cliente = :cliente')
            ->setParameter('cliente', $cliente);

        $result = $query->getQuery()->getResult();

        return $result; 
    }
}
