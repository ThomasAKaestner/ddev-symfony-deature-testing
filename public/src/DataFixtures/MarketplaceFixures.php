<?php

namespace App\DataFixtures;

use App\Entity\Marketplace;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MarketplaceFixures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $marketplace = new Marketplace();
        $marketplace->setName('Otto');
        $manager->persist($marketplace);

        $marketplace1 = new Marketplace();
        $marketplace1->setName('Zalando');
        $manager->persist($marketplace1);

        $marketplace2 = new Marketplace();
        $marketplace2->setName('About You');
        $manager->persist($marketplace2);

        $manager->flush();
    }
}
