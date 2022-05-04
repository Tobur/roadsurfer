<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Enum\OrderStatus;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OrderFixture extends BaseFixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        parent::load($manager);
        for ($i = 0; $i <= 10000; $i++) {
            $order = new Order();
            $randomStationNumber = rand(0, 10);
            $order->setStationStart($this->getReference("$randomStationNumber-station"));
            $campervanInventoryNumber = rand(0, 150);
            $order->setCampervanInventory($this->getReference("$campervanInventoryNumber-inventoryCampervan"));
            $dateStart = new \DateTime($this->faker->date());
            $dateStart->modify("-{$randomStationNumber} months");
            $dateEnd = new \DateTime($this->faker->date());
            $dateEnd->modify("+{$campervanInventoryNumber} months");
            $order->setRentalStartDate($dateStart);
            $order->setRentalEndDate($dateEnd);
            $today = new \DateTime();

            if ($randomStationNumber % 2 == 0 && $dateEnd <= $today) {
                $randomEndStationNumber = rand(0, 10);
                $order->setStationEnd($this->getReference("$randomEndStationNumber-station"));
                $order->setStatus(OrderStatus::FINISHED);
            } else {
                if (rand(1, 10) % 2 == 0 && $dateEnd >= $today) {
                    $order->setStatus(OrderStatus::IN_PROGRESS);
                } else {
                    $order->setStatus(OrderStatus::CREATED);
                }
            }

            $manager->persist($order);
            $this->addReference("$i-order", $order);
        }

        $manager->flush();
    }

    /**
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [
            InventoryCampervanFixture::class,
            StationFixture::class,
        ];
    }
}
