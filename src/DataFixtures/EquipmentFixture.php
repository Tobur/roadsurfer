<?php

namespace App\DataFixtures;

use App\Entity\Equipment;
use Doctrine\Persistence\ObjectManager;

class EquipmentFixture extends BaseFixture
{
    /**
     * @param  ObjectManager  $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        parent::load($manager);
        for ($i = 0; $i <= 10; $i++) {
            $equipment = new Equipment();
            $equipment->setName($this->faker->firstName);
            $manager->persist($equipment);
            $this->addReference("$i-equipment", $equipment);
        }

        $manager->flush();
    }
}
