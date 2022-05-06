<?php

namespace App\Service;

use App\Entity\OrderForecast;
use App\Repository\OrderForecastRepository;
use App\Repository\OrderRepository;
use App\Repository\StationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

class OrderHistoricalForecast
{
    public function __construct(
        protected OrderForecastRepository $orderForecastRepository,
        protected OrderRepository $orderRepository,
        protected StationRepository $stationRepository,
        protected EntityManagerInterface $em
    ) {
    }

    /**
     * @param  \DateTimeInterface  $date
     * @return Collection
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function forecastForASingleDay(\DateTimeInterface $date): Collection
    {
        $data = $this->orderRepository->countByAllPeriodAndForAllStation($date);
        $collection = new ArrayCollection();
        foreach ($data as $value) {
            $station = $this->stationRepository->find($value['station_id']);
            $orderForecast = $this->orderForecastRepository->findByDateAndStation($date, $station);
            if (!$orderForecast) {
                $orderForecast = new OrderForecast();
            }
            $orderForecast->setStation($station);
            $forecastNumberOfCampervan = $value['sum'] / $value['count'];
            $orderForecast->setExpectedAmount(number_format($forecastNumberOfCampervan));
            $orderForecast->setRentalDate($date);
            $this->em->persist($orderForecast);
            $collection->add($orderForecast);
        }

        $this->em->flush();

        return $collection;
    }
}
