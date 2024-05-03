<?php

namespace App\DataFixtures;

use App\Factory\EstudianteFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        EstudianteFactory::createMany(10);

        $manager->flush();
    }
}
