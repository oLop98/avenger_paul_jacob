<?php

// src/Repository/LivresRepository.php

namespace App\Repository;

use App\Entity\Caillou;
use App\Entity\MarquePage;
use App\Entity\Livres;
// LivresRepository.php

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class LivresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livres::class);
    }

    public function livresAuteurPremiereLettre($letter)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.titre LIKE :letter')
            ->setParameter('letter', $letter . '%')
            ->getQuery()
            ->getResult();
    }

// LivresRepository.php

public function AuteurNbLivre()
{
    $entityManager = $this->getEntityManager();

    $query = $entityManager->createQuery(
        'SELECT a.nom as auteur, COUNT(l.id) as nombreLivres
        FROM App\Entity\Livres l
        JOIN l.auteur a
        GROUP BY a.id
        HAVING COUNT(l.id) > 2'
    );

    return $query->getResult();
}


    

    public function countBooks()
    {
        return $this->createQueryBuilder('l')
            ->select('COUNT(l.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}


    /* FindAuteurByNbdelivre($nbLivre): array
    {
    $query = $entitymanager->createQuery(
        'SELECT a, count(1) AS NbLivres
        FROM App\Entity\Auteur a
        JOIN a.livres l
        GROUP by a.id
        HAVING NbLivres > :$nbLivre'
        )->setParameter('nbLivre",$nbLivres);
        return $query->getResult();

    }
    
    
    
    */

