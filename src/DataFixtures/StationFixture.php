<?php

namespace App\DataFixtures;

use App\Entity\Station;
use Doctrine\Persistence\ObjectManager;

class StationFixture extends BaseFixture
{
    /**
     * @param  ObjectManager  $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        parent::load($manager);
        for ($i = 0; $i <= 10; $i++) {
            $equipment = new Station();
            $equipment->setName($this->faker->languageCode . '-' . $this->faker->monthName);
            $manager->persist($equipment);
            $this->addReference("$i-station", $equipment);
        }

        $manager->flush();
    }
}
