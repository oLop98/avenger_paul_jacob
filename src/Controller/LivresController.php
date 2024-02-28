<?php

namespace App\Controller;

use App\Form\Type\LivreType;
use App\Form\Type\AuteurType;


use App\Entity\Caillou;
use App\Entity\MarquePage;
use App\Entity\Livres;
use App\Entity\Auteurs;


use Doctrine\ORM\EntityManagerInterface;
use App\Repository\LivresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;


class LivresController extends AbstractController
{
    #[Route('/livres', name: 'app_livres')]
    public function getAll(EntityManagerInterface $entityManager, Request $request): Response
    {
        $livres = $entityManager->getRepository(Livres::class)->findAll();
        $auteurs = $entityManager->getRepository(Auteurs::class)->findAll();

        $newLivre = new Livres();
        $formLivre = $this->createForm(AuteurType::class, $newLivre, [
            'auteurs' => $auteurs,
        ]);

        $formLivre->handleRequest($request);

        if ($formLivre->isSubmitted() && $formLivre->isValid()) {
            // Gérer la soumission du formulaire
            $entityManager->persist($newLivre);
            $entityManager->flush();

            return $this->redirectToRoute('app_livres');
        }

        return $this->render('livres/index.html.twig', [
            'livres' => $livres,
            'formLivre' => $formLivre->createView(),
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

        public function ajout(Request $request, ManagerRegistry $doctrine)
        {
            // Création d’un objet Livre vierge
            $livre = new Livres();
            $form = $this->createForm(LivreType::class, $livre);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) 
            {
                // $form->getData() : pour récupérer les données
                // Les données sont déjà stockées dans la variable d’origine
                // $livre = $form->getData();
                // ... Effectuer le/les traitements(s) à réaliser
                // Par exemple :
                $entityManager = $doctrine->getManager();
                $entityManager->persist($livre);
                $entityManager->flush();
                return $this->redirectToRoute('livre_succes');
            }
            return $this->render('livre/ajout.html.twig', ['form' => $form,]);
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

#[Route('/requete', name: 'requete')]
public function livresAuteurPremiereLettre(LivresRepository $LivresRepository): Response
{
    $livresA = $LivresRepository->livresAuteurPremiereLettre('L');

    return $this->render('bookmark/requete.html.twig', [
        'livresA' => $livresA,
    ]);
}

#[Route('/requete', name: 'requete')]
public function AuteurNbLivre(LivresRepository $LivresRepository): Response
{
    $AuteurNbLivre = $LivresRepository->AuteurNbLivre();

    return $this->render('bookmark/requete.html.twig', [
        'AuteurNbLivre' => $AuteurNbLivre,
    ]);
}

#[Route('/total-books', name: 'total_books')]
public function totalBooks(LivresRepository $LivresRepository): Response
{
    $totalLivres = $LivresRepository->countBooks();

    return $this->render('bookmark/requete.html.twig', [
        'totalLivres' => $totalLivres,
    ]);
}

#[Route('/requete', name: 'requete')]
public function resultat(LivresRepository $LivresRepository): Response
{
    $livresA = $LivresRepository->livresAuteurPremiereLettre('L');
    $AuteurNbLivre = $LivresRepository->AuteurNbLivre();
    $totalLivres = $LivresRepository->countBooks();

    return $this->render('bookmark/requete.html.twig', [
        'livresA' => $livresA,
        'AuteurNbLivre' => $AuteurNbLivre,
        'totalLivres' => $totalLivres,
    ]);
}
//a modifier
#[Route('/livre_succes', name: 'livre_succes')]
public function auteurSucces(): Response
{
    return $this->render('livres/livre_succes.html.twig');
}
}