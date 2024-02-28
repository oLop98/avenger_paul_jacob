<?php

namespace App\Controller;

use App\Form\Type\AuteurType;
use App\Form\Type\LivreType;
use App\Entity\Auteurs;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuteursController extends AbstractController
{
    #[Route('/auteurs', name: 'app_auteurs')]
    public function getAllAuteur(EntityManagerInterface $entityManager, Request $request): Response
    {
        $auteurs = $entityManager->getRepository(Auteurs::class)->findAll();
        $newAuteur = new Auteurs();
        $formAuteur = $this->createForm(LivreType::class, $newAuteur);
    
        $formAuteur->handleRequest($request);
    
        if ($formAuteur->isSubmitted() && $formAuteur->isValid()) {
            $entityManager->persist($newAuteur);
            $entityManager->flush();
    
            return $this->redirectToRoute('auteur_succes', ['auteur' => $newAuteur]);
        }
    
        return $this->render('auteurs/ajout.html.twig', [
            'auteurs' => $auteurs,
            'formAuteur' => $formAuteur->createView(),
        ]);
    }
    
    #[Route('/contenuauteurs/{id}', requirements: ["id" => "\d+"], name: 'contenuauteurs')]
    public function detailAuteur(int $id, EntityManagerInterface $entityManager): Response
    {
        $auteur = $entityManager->getRepository(Auteurs::class)->find($id);
    
        if (!$auteur) {
            throw $this->createNotFoundException("L'auteur demandé n'existe pas");
        }
    
        return $this->render('auteurs/auteurdetail.html.twig', [
            'auteur' => $auteur,
        ]);
    }

    #[Route('/auteur_succes', name: 'auteur_succes')]
    public function auteurSucces(): Response
    {
        return $this->render('auteurs/auteur_succes.html.twig');
    }
}
