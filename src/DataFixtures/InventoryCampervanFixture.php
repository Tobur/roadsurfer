<?php

namespace App\DataFixtures;

use App\Entity\Campervan;
use App\Entity\InventoryCampervan;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class InventoryCampervanFixture extends BaseFixture implements DependentFixtureInterface
{
    /**
     * @param  ObjectManager  $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        parent::load($manager);
        for ($i = 0; $i <= 150; $i++) {
            $campervanInventory = new InventoryCampervan();
            $campervanInventory->setSku($this->faker->localIpv4);
            $campervanNumber = rand(1, 30);
            /** @var Campervan $campervan */
            $campervan = $this->getReference("$campervanNumber-campervan");
            $campervan->addInventory($campervanInventory);
            $stationNumber = rand(1, 10);
            $campervanInventory->setStation($this->getReference("$stationNumber-station"));
            $manager->persist($campervanInventory);
            $this->addReference("$i-inventoryCampervan", $campervanInventory);
        }

        $manager->flush();
    }

    /**
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [
            CampervanFixture::class,
            StationFixture::class,
        ];
    }
}
