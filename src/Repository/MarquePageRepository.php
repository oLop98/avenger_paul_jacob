<?php

namespace App\Repository;

use App\Entity\Livres;
use App\Entity\MarquePage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MarquePageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MarquePage::class);
    }


}
