<?php

namespace App\Controller;

use App\Entity\Livres;
use App\Entity\MotsCles;
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

    #[Route("ajouter", name: "marquepage_ajouter")]
    public function ajouterMarquePage(EntityManagerInterface $entityManager): Response
    {

        $marquePage = new MarquePage();
        $marquePage->setUrl("https://example.com");
        $marquePage->setCommentaire("Un commentaire");
        $marquePage->setdateDeCreation(new \DateTime());
        
        $motsCles = ["ZZZZ", "AAAA", "BBBB"];

          
          foreach ($motsCles as $mot) {
            $mc = new MotsCles();
            $mc->setMots($mot);

            $marquePage->addMots($mc);
            $entityManager->persist($mc);
        }




        

        $entityManager->persist($mc);
        $entityManager->persist($marquePage);
        $entityManager->flush();
        


        return new Response("Marque-page suivant ajouté avec succès :<br> l'id " . $marquePage->getId() . " <br>à la date du " . $marquePage->getdateDeCreation()->format('Y-m-d H:i:s'));
    }

    #[Route('detail/{id}', requirements: ["page"=>"\d+"], name: 'detail')]
    public function detail(int $id, EntityManagerInterface $entityManager): Response {
        $marquePage = $entityManager->getRepository(MarquePage::class)->find($id);

        if (!$marquePage) {
            throw $this->createNotFoundException("Le marque-page demandé n'existe pas");
        }

        return $this->render('marquep/detail.html.twig', [
            'marquePage' => $marquePage,
        ]);
    }

    public function motscle(EntityManagerInterface $entityManager):Response
    {
        $motscle = new MotsCle();
        $motscle->setIdmrp($marquePage);
        $motscle->setMots("Un Mot Clé");

    }

    }


