<?php

namespace App\Entity;

use App\Repository\CatDiasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CatDiasRepository::class)]
class CatDias
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $dias = null;

    #[ORM\OneToMany(mappedBy: 'dia', targetEntity: CatProceso::class)]
    private Collection $catProcesos;

    public function __construct()
    {
        $this->catProcesos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDias(): ?int
    {
        return $this->dias;
    }

    public function setDias(int $dias): static
    {
        $this->dias = $dias;

        return $this;
    }

    /**
     * @return Collection<int, CatProceso>
     */
    public function getCatProcesos(): Collection
    {
        return $this->catProcesos;
    }

    public function addCatProceso(CatProceso $catProceso): static
    {
        if (!$this->catProcesos->contains($catProceso)) {
            $this->catProcesos->add($catProceso);
            $catProceso->setDia($this);
        }

        return $this;
    }

    public function removeCatProceso(CatProceso $catProceso): static
    {
        if ($this->catProcesos->removeElement($catProceso)) {
            // set the owning side to null (unless already changed)
            if ($catProceso->getDia() === $this) {
                $catProceso->setDia(null);
            }
        }

        return $this;
    }
}
