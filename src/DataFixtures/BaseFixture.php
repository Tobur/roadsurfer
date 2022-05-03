<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

abstract class BaseFixture extends Fixture
{
    /** @var Generator */
    protected Generator $faker;
    /** @var ObjectManager  */
    protected ObjectManager $manager;

    /**
     * @param  ObjectManager  $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;
        $this->faker = Factory::create();
    }
}
