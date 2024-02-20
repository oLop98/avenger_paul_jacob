<?php

namespace App\Entity;

use App\Repository\MotsClesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MotsClesRepository::class)]
class MotsCles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $mots = null;

    #[ORM\ManyToMany(targetEntity: MarquePage::class, mappedBy: 'motsCles')]
    private Collection $marquePages;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getMots(): ?string
    {
        return $this->mots;
    }

    public function setMots(string $mots): static
    {
        $this->mots = $mots;

        return $this;
    }


        /**
     * @return Collection<int, MarquePage>
     */
    public function getMarquePages(): Collection
    {
        return $this->marquePages;
    }

    public function addMarquePage(MarquePage $marquePage): static
    {
        if (!$this->marquePages->contains($marquePage)) {
            $this->marquePages->add($marquePage);
            $marquePage->addMots($this);
        }

        return $this;
    }

    public function removeMarquePage(MarquePage $marquePage): static
    {
        if ($this->marquePages->removeElement($marquePage)) {
            $marquePage->removeMots($this);
        }

        return $this;
    }

}
