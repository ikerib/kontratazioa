<?php

namespace App\DataFixtures;

use App\Factory\KontratistaFactory;
use App\Factory\KontratuaFactory;
use App\Factory\MotaFactory;
use App\Factory\ProzeduraFactory;
use App\Factory\SailaFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        MotaFactory::createMany(11);
        ProzeduraFactory::createMany(11);
        KontratistaFactory::createMany(11);
        SailaFactory::createMany(11);

        KontratuaFactory::createMany(102, [
            'mota'          => MotaFactory::random(),
            'prozedura'     => ProzeduraFactory::random(),
            'kontratista'   => KontratistaFactory::random(),
            'saila'         => SailaFactory::random()
        ]);

        $manager->flush();
    }
}
