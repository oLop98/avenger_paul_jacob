<?php

namespace App\DataFixtures;
use App\Entity\MotsCles;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookmarkFixtures extends Fixture
{
        public function load(ObjectManager $manager)
        {
            $motsaleatoire = ["OJEML", "ZZZZ", "AAAA", "BBBE", "Mot1", "Mot2", "Mot3"];
            
    
            for ($i = 0; $i < 35; $i++)
            {
                $motscle = new MotsCles();
                $motKey = array_rand($motsaleatoire);
                $motscle->setMots($motsaleatoire[$motKey]);
                $manager->persist($motscle);
            }
            $manager->flush();
        }

}
