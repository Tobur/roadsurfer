<?php

namespace App\Repository;

use App\Entity\OrderForecast;
use App\Entity\Station;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrderForecast>
 *
 * @method OrderForecast|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderForecast|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderForecast[]    findAll()
 * @method OrderForecast[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderForecastRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderForecast::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(OrderForecast $entity, bool $flush = true): void
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
    public function remove(OrderForecast $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @param  \DateTime  $date
     * @param  Station  $station
     * @return OrderForecast|null
     * @throws NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findByDateAndStation(\DateTime $date, Station $station): ?OrderForecast
    {
        try {
            return $this->createQueryBuilder('o')
                ->where('o.rentalDate = :date')
                ->andWhere('o.station = :stationId')
                ->setParameter('date', $date->format('Y-m-d'))
                ->setParameter('stationId', $station->getId())
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $noResultException) {
            return null;
        }
     }

    /*
    public function findOneBySomeField($value): ?OrderForecast
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
