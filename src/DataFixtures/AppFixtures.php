<?php

namespace App\DataFixtures;

use App\Entity\Teachr;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
            $teachr = new Teachr();
            $teachr
                ->setFirstname($faker->firstName($gender = null))
                ->setCreatedAt($faker->dateTimeThisMonth());
            $manager->persist($teachr);
        }

        $manager->flush();
    }
}
