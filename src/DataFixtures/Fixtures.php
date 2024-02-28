<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Livres;

class Fixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 30; $i++) {
            $livre = new Livres();
            $livre->setTitre('Livre ' . $i);
            
            $auteurReference = $this->getReference('auteur_' . mt_rand(0, 29));
            
            $livre->setAuteurId($auteurReference->getId()); 
            
            $manager->persist($livre);
        }
    
        $manager->flush();
    }
}
