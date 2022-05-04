<?php

namespace App\DataFixtures;

use App\Entity\Equipment;
use App\Entity\InventoryEquipment;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class InventoryEquipmentFixture extends BaseFixture implements DependentFixtureInterface
{
    /**
     * @param  ObjectManager  $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        parent::load($manager);
        for ($i = 0; $i <= 150; $i++) {
            $equipmentInventory = new InventoryEquipment();
            $equipmentInventory->setSku($this->faker->unique()->ipv6);
            $equipmentNumber = rand(0, 10);
            /** @var Equipment $equipmentInventory */
            $equipment = $this->getReference("$equipmentNumber-equipment");
            $equipment->addInventory($equipmentInventory);
            $stationNumber = rand(0, 10);
            $equipmentInventory->setStation($this->getReference("$stationNumber-station"));
            $manager->persist($equipmentInventory);
            $this->addReference("$i-inventoryEquipment", $equipmentInventory);
        }

        $manager->flush();
    }

    /**
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [
            EquipmentFixture::class,
            StationFixture::class,
        ];
    }
}
