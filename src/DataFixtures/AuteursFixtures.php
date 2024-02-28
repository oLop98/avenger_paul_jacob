<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Auteurs;

class AuteursFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $prenoms = ["Alice", "Bob", "Charlie", "David", "Eva", "Frank", "Grace", "Henry", "Ivy", "Jack"];
        $noms = ["Dupuis", "Depuis", "Delacour", "Danslacour", "Potter", "Jedusor", "Dumbledor", "Wonka", "Rogue", "Flipper"];
    
        for ($i = 0; $i < 30; $i++) {
            $auteur = new Auteurs();
            $auteur->setPrenom($prenoms[array_rand($prenoms)]);
            $auteur->setNom($noms[array_rand($noms)]);  
            $manager->persist($auteur);
            
            $this->addReference('auteur_' . $i, $auteur);
        }
    
        $manager->flush();   
        $this->addReference('all_auteurs', $auteur);
    }
}
