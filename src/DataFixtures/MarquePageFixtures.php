<?php
namespace App\DataFixtures;

use App\Entity\MarquePage;
use App\Entity\MotsCles;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MarquePageFixtures extends Fixture
{
    private array $motsClesList = ["Mot1", "Mot2", "Mot3"];

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 25; $i++) {
            $marquePage = new MarquePage();
            $marquePage->setUrl("https://example.com");
            $marquePage->setCommentaire("Un commentaire");
            $marquePage->setDateDeCreation(new \DateTime());

            $randomMotsCles = array_slice($this->motsClesList, 0, rand(2, 5));

            foreach ($randomMotsCles as $mot) {
                $mc = new MotsCles();
                $mc->setMots($mot);

                $marquePage->addMots($mc); // Utiliser la méthode addMot, pas addMots
                $manager->persist($mc);
            }

            $manager->persist($marquePage);
        }

        $manager->flush();
    }
}


