<?php

namespace App\Controller;

use App\Entity\MarquePage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

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
}

