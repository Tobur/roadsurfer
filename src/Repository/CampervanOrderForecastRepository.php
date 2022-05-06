<?php

namespace App\Repository;

use App\Entity\CampervanOrderForecast;
use App\Entity\OrderForecast;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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
class CampervanOrderForecastRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CampervanOrderForecast::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(CampervanOrderForecast $entity, bool $flush = true): void
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
    public function remove(CampervanOrderForecast $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
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
