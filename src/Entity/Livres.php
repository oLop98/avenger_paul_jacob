<?php

namespace App\Entity;

use App\Repository\LivresRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: LivresRepository::class)]
class Livres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\ManyToOne(targetEntity: Auteurs::class)]
    #[ORM\JoinColumn(name: 'auteur_id', referencedColumnName: 'id')]
    private ?Auteurs $auteur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getAuteur(): ?Auteurs
    {
        return $this->auteur;
    }

    public function setAuteur(?Auteurs $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }
}

