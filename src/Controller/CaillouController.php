<?php

namespace App\Controller;

use App\Entity\MarquePage;
use App\Entity\Caillou;
use App\Entity\Photo;
use App\Form\CaillouType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CaillouController extends AbstractController
{
    #[Route('/caillou', name: 'app_caillou')]
    public function getAll(EntityManagerInterface $entityManager, Request $request): Response
    {
        $cayoux = $entityManager->getRepository(Caillou::class)->findAll();

        // Créer le formulaire d'ajout de nouvelle catégorie
        $newCaillou = new Caillou();
        $form = $this->createForm(CaillouType::class, $newCaillou);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($newCaillou);
            $entityManager->flush();

            // Rediriger ou effectuer d'autres actions après ajout
            return $this->redirectToRoute('app_caillou');
        }

        return $this->render('caillou/index.html.twig', [
            'cayoux' => $cayoux,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/contenucaillou/{id}', requirements: ["id"=>"\d+"], name: 'contenucaillou')]
    public function detail(int $id, EntityManagerInterface $entityManager): Response
    {
        $cayou = $entityManager->getRepository(Caillou::class)->find($id);

        if (!$cayou) {
            throw $this->createNotFoundException("La catégorie demandée n'existe pas");
        }

        $photos = $entityManager->getRepository(Photo::class)->findBy(['categorie' => $cayou]);

        return $this->render('caillou/detail.html.twig', [
            'cayou' => $cayou,
            'photos' => $photos,
        ]);
    }
}
