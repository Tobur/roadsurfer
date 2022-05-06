<?php

namespace App\Repository;

use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Result;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Order>
 *
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Order $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Order $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function countNumberOfOrdersForAllPeriod(\DateTimeInterface $date): mixed
    {
        return $this->createQueryBuilder('orders')
            ->select(
                "CONCAT(EXTRACT(YEAR FROM orders.rentalStartDate), '-',".
                " EXTRACT(MONTH FROM  orders.rentalStartDate)) as pattern, station.id as stationId,".
                " COUNT(orders.id) as number"
            )
            ->join('orders.campervanInventory', 'inventories')
            ->join('inventories.station', 'station')
            ->where("CONCAT(EXTRACT(MONTH FROM orders.rentalStartDate), '-', ".
                    "EXTRACT(DAY FROM  orders.rentalStartDate)) = :date")
            ->setParameter('date', $date->format('n-j'))
            ->groupBy('pattern')
            ->addGroupBy('stationId')
            ->getQuery()
            ->getResult();
    }

    public function countByAllPeriodAndForAllStation(\DateTimeInterface $date): array
    {
        $date = $date->format('n-j');
        $query = <<<EOT
              SELECT SUM(data.number), COUNT(*), data.stationId as station_id FROM (
                SELECT CONCAT(EXTRACT(YEAR FROM o0_.rental_start_date), '-', EXTRACT(MONTH FROM o0_.rental_start_date))
                       AS sclr_0,COUNT(*) as number, s2_.id as stationId
                FROM orders o0_
                INNER JOIN inventory i1_ ON o0_.campervan_inventory_id = i1_.id AND i1_.type = 'campervan'
                INNER JOIN station s2_ ON i1_.station_id = s2_.id
                WHERE CONCAT(EXTRACT(MONTH FROM o0_.rental_start_date), '-', EXTRACT(DAY FROM o0_.rental_start_date)) = :date
                GROUP BY sclr_0, stationId
             ) as data GROUP BY data.stationId
EOT;
        $stmt = $this->getEntityManager()
            ->getConnection()
            ->prepare($query);

        $stmt->bindParam('date', $date);

        return $stmt->executeQuery()->fetchAllAssociative();
    }

    /*
    public function findOneBySomeField($value): ?Order
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
