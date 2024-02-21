<?php

namespace App\Controller;


use App\Entity\Livres;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LivresController extends AbstractController
{
    #[Route('/livres', name: 'app_livres')]
    public function getAll(EntityManagerInterface $entityManager): Response
    {
        $livres= $entityManager->getRepository(Livres::class)->findAll();

        return $this->render('livres/index.html.twig', [
            'livres' => $livres,
        ]);
    }


    #[Route("/livre/ajouter", name: "livre_ajouter")]
        public function ajouterLivre(EntityManagerInterface $entityManager): Response
        {
            $livre = new Livres();
            $livre->setAuteur("Marc Zuckerberg");
            $livre->setTitre("Dance avec le mal");
            $entityManager->persist($livre);
            $entityManager->flush();


            return new Response("Livre sauvegardé avec l'id ". $livre->getId());
        }

        #[Route('detaillivre/{id}', requirements: ["page"=>"\d+"], name: 'detaillivre')]
        public function detail(int $id, EntityManagerInterface $entityManager): Response {
            $livre = $entityManager->getRepository(Livres::class)->find($id);
    
            if (!$livre) {
                throw $this->createNotFoundException("Le livre demandé n'existe pas");
            }
    
            return $this->render('livres/detail.html.twig', [
                'livre' => $livre,
            ]);
        }

    #[Route("/livre/fiche/{id}", name: "livre_fiche", requirements: ["id" => "\d+"])]
        public function afficherLivre(int $id, EntityManagerInterface $entityManager):Response
        {
        
        return new Response('Titre : '. $livre->getTitre());
}
}