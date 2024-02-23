<?php

namespace App\DataFixtures;
use App\Entity\Livres;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Fixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $noms = ["Alice", "Bob", "Charlie", "David", "Eva", "Frank", "Grace", "Henry", "Ivy", "Jack"];
    
        for ($i = 0; $i < 30; $i++) {
            $livre = new Livres();
            $livre->setTitre('Livre ' . $i);
            $auteurKey = array_rand($noms);
            $livre->setAuteur($noms[$auteurKey]);
            
            $manager->persist($livre);
        }
    
        $manager->flush();
    }
}    