<?php

namespace App\DataFixtures;

use App\Entity\OrderEquipment;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OrderEquipmentFixture extends BaseFixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        parent::load($manager);
        for ($i = 0; $i <= 40000; $i++) {
            $orderEquipment = new OrderEquipment();
            $orderEquipment->setAmount(rand(1, 3));
            $orderNumber = rand(0, 10000);
            $orderEquipment->setOrder($this->getReference("$orderNumber-order"));
            $orderEquipmentInventoryNumber = rand(0, 150);
            $orderEquipment->setInventory(
                $this->getReference("$orderEquipmentInventoryNumber-inventoryEquipment")
            );
            $manager->persist($orderEquipment);
        }
        $manager->flush();
    }

    /**
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [
            OrderFixture::class,
        ];
    }
}
