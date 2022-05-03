<?php

namespace App\DataFixtures;

use App\Entity\Campervan;
use Doctrine\Persistence\ObjectManager;

class CampervanFixture extends BaseFixture
{
    /**
     * @param  ObjectManager  $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        parent::load($manager);
        for ($i = 0; $i <= 30; $i++) {
            $campervan = new Campervan();
            $campervan->setName($this->faker->firstName);
            $manager->persist($campervan);
            $this->addReference("$i-campervan", $campervan);
        };

        $manager->flush();
    }
}
