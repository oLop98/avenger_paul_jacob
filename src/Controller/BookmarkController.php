<?php

namespace App\Controller;

use App\Entity\MotsCles;
use App\Entity\MarquePage;
use App\Repository\MarquePageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookmarkController extends AbstractController
{
    #[Route('/')]
    public function getAll(EntityManagerInterface $entityManager): Response
    {
        $marquePages = $entityManager->getRepository(MarquePage::class)->findAll();

        return $this->render('bookmark/index.html.twig', [
            'marquePages' => $marquePages,
        ]);
    }

    #[Route("ajouter", name: "marquepage_ajouter")]
    public function ajouterMarquePage(EntityManagerInterface $entityManager): Response
    {
        // Récupérer tous les mots-clés de la base de données
        $motsClesList = $entityManager->getRepository(MotsCles::class)->findAll();
    
        for ($i = 0; $i < 25; $i++) {
            $marquePage = new MarquePage();
            $marquePage->setUrl("https://example.com");
            $marquePage->setCommentaire("Un commentaire");
            $marquePage->setDateDeCreation(new \DateTime());
    
            // Utiliser les mots-clés récupérés
            $randomMotsCles = array_slice($motsClesList, 0, rand(2, 5));
    
            foreach ($randomMotsCles as $mot) {
                $marquePage->addMot($mot); // Utiliser addMot au lieu de setMots
            }
    
            $entityManager->persist($marquePage);
        }
    
        $entityManager->flush();
    
        return new Response("Marque-pages ajoutés avec succès.");
    }
    
// Le paramètre "\d+" où "\d" signifie un caractère décimal et le "+" signifie qu'il doit apparaitre au moins une fois pour correspondre
    #[Route('detail/{id}', requirements: ["id"=>"\d+"], name: 'detail')]
    public function detail(int $id, EntityManagerInterface $entityManager): Response
    {
        $marquePage = $entityManager->getRepository(MarquePage::class)->find($id);

        if (!$marquePage) {
            throw $this->createNotFoundException("Le marque-page demandé n'existe pas");
        }

        return $this->render('marquep/detail.html.twig', [
            'marquePage' => $marquePage,
        ]);
    }


}
