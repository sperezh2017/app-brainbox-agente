<?php

namespace App\Entity;

use App\Repository\CatMesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CatMesRepository::class)]
class CatMes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $mes = null;

    #[ORM\OneToMany(mappedBy: 'mes', targetEntity: CatProceso::class)]
    private Collection $catProcesos;

    #[ORM\OneToMany(mappedBy: 'mes', targetEntity: ClienteProceso::class)]
    private Collection $clienteProcesos;

    #[ORM\OneToMany(mappedBy: 'mes', targetEntity: CalendarioSri::class)]
    private Collection $calendarioSris;

    public function __construct()
    {
        $this->catProcesos = new ArrayCollection();
        $this->clienteProcesos = new ArrayCollection();
        $this->calendarioSris = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMes(): ?string
    {
        return $this->mes;
    }

    public function setMes(string $mes): static
    {
        $this->mes = $mes;

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
            $catProceso->setMes($this);
        }

        return $this;
    }

    public function removeCatProceso(CatProceso $catProceso): static
    {
        if ($this->catProcesos->removeElement($catProceso)) {
            // set the owning side to null (unless already changed)
            if ($catProceso->getMes() === $this) {
                $catProceso->setMes(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ClienteProceso>
     */
    public function getClienteProcesos(): Collection
    {
        return $this->clienteProcesos;
    }

    public function addClienteProceso(ClienteProceso $clienteProceso): static
    {
        if (!$this->clienteProcesos->contains($clienteProceso)) {
            $this->clienteProcesos->add($clienteProceso);
            $clienteProceso->setMes($this);
        }

        return $this;
    }

    public function removeClienteProceso(ClienteProceso $clienteProceso): static
    {
        if ($this->clienteProcesos->removeElement($clienteProceso)) {
            // set the owning side to null (unless already changed)
            if ($clienteProceso->getMes() === $this) {
                $clienteProceso->setMes(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CalendarioSri>
     */
    public function getCalendarioSris(): Collection
    {
        return $this->calendarioSris;
    }

    public function addCalendarioSri(CalendarioSri $calendarioSri): static
    {
        if (!$this->calendarioSris->contains($calendarioSri)) {
            $this->calendarioSris->add($calendarioSri);
            $calendarioSri->setMes($this);
        }

        return $this;
    }

    public function removeCalendarioSri(CalendarioSri $calendarioSri): static
    {
        if ($this->calendarioSris->removeElement($calendarioSri)) {
            // set the owning side to null (unless already changed)
            if ($calendarioSri->getMes() === $this) {
                $calendarioSri->setMes(null);
            }
        }

        return $this;
    }
}
