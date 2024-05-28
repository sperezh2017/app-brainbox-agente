<?php

namespace App\Repository;

use App\Entity\ProTransaccion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProTransaccion>
 *
 * @method ProTransaccion|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProTransaccion|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProTransaccion[]    findAll()
 * @method ProTransaccion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProTransaccionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProTransaccion::class);
    }

//    /**
//     * @return ProTransaccion[] Returns an array of ProTransaccion objects
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

//    public function findOneBySomeField($value): ?ProTransaccion
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function buscarPlantillas($fecha,$clienteId,$procesoId,$etiquetaId,$estadoId,$filtFecha)
    {
        $entityManager = $this->getEntityManager();
        $conn = $entityManager->getConnection();

        // Prepara el SQL con los parámetros
        $sql = 'EXEC dbo.get_procesos @tVence = :fecha, @nCliente_Id = :clienteId, @nProceso_Id = :procesoId, @nEtiqueta_Id = :etiquetaId, @nEstado_Id = :estadoId, @cFecha_Filtro = :filtfecha';
        // Añade más parámetros al SQL según sea necesario

        $stmt = $conn->prepare($sql);
        $stmt->bindValue('fecha', $fecha->format('Y-m-d H:i:s'));
        $stmt->bindValue('clienteId', $clienteId);
        $stmt->bindValue('procesoId', $procesoId);
        $stmt->bindValue('etiquetaId', $etiquetaId);
        $stmt->bindValue('estadoId', $estadoId);
        $stmt->bindValue('filtfecha', $filtFecha);
        $result = $stmt->executeQuery();
        $result = $result->fetchAllAssociative();

        //$result = $stmt->fetch();

        return $result;
    }
}
