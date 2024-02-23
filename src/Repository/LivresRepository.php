<?php

// src/Repository/LivresRepository.php

namespace App\Repository;

use App\Entity\Caillou;
use App\Entity\MarquePage;
use App\Entity\Livres;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class LivresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livres::class);
    }

    public function findByTitleStartingWith($letter)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.titre LIKE :letter')
            ->setParameter('letter', $letter . '%')
            ->getQuery()
            ->getResult();
    }


    public function findAuthorsWithMoreThan5Books()
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT m.auteur as auteur, COUNT(m.id) as nombreLivres
            FROM App\Entity\Livres m
            GROUP BY m.auteur
            HAVING COUNT(m.id) > 0'
        );
    
        return $query->getResult();
    }

    public function countBooks()
    {
        return $this->createQueryBuilder('m')
            ->select('COUNT(m.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
