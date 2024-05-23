<?php

namespace App\Entity;

use App\Repository\CliTipoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CliTipoRepository::class)]
class CliTipo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $tipo = null;

    #[ORM\Column]
    private ?bool $inactivo = null;

    #[ORM\Column]
    private ?bool $eliminar = null;

    #[ORM\OneToMany(mappedBy: 'CliTipo', targetEntity: Cliente::class)]
    private Collection $clientes;

    #[ORM\OneToMany(mappedBy: 'clitipo', targetEntity: CalendarioSri::class)]
    private Collection $calendarioSris;

    #[ORM\OneToMany(mappedBy: 'clitipo', targetEntity: CatCalendarioCab::class)]
    private Collection $catCalendarioCabs;

    public function __construct()
    {
        $this->clientes = new ArrayCollection();
        $this->calendarioSris = new ArrayCollection();
        $this->catCalendarioCabs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): static
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function isInactivo(): ?bool
    {
        return $this->inactivo;
    }

    public function setInactivo(bool $inactivo): static
    {
        $this->inactivo = $inactivo;

        return $this;
    }

    public function isEliminar(): ?bool
    {
        return $this->eliminar;
    }

    public function setEliminar(bool $eliminar): static
    {
        $this->eliminar = $eliminar;

        return $this;
    }

    /**
     * @return Collection<int, Cliente>
     */
    public function getClientes(): Collection
    {
        return $this->clientes;
    }

    public function addCliente(Cliente $cliente): static
    {
        if (!$this->clientes->contains($cliente)) {
            $this->clientes->add($cliente);
            $cliente->setCliTipo($this);
        }

        return $this;
    }

    public function removeCliente(Cliente $cliente): static
    {
        if ($this->clientes->removeElement($cliente)) {
            // set the owning side to null (unless already changed)
            if ($cliente->getCliTipo() === $this) {
                $cliente->setCliTipo(null);
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
            $calendarioSri->setClitipo($this);
        }

        return $this;
    }

    public function removeCalendarioSri(CalendarioSri $calendarioSri): static
    {
        if ($this->calendarioSris->removeElement($calendarioSri)) {
            // set the owning side to null (unless already changed)
            if ($calendarioSri->getClitipo() === $this) {
                $calendarioSri->setClitipo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CatCalendarioCab>
     */
    public function getCatCalendarioCabs(): Collection
    {
        return $this->catCalendarioCabs;
    }

    public function addCatCalendarioCab(CatCalendarioCab $catCalendarioCab): static
    {
        if (!$this->catCalendarioCabs->contains($catCalendarioCab)) {
            $this->catCalendarioCabs->add($catCalendarioCab);
            $catCalendarioCab->setClitipo($this);
        }

        return $this;
    }

    public function removeCatCalendarioCab(CatCalendarioCab $catCalendarioCab): static
    {
        if ($this->catCalendarioCabs->removeElement($catCalendarioCab)) {
            // set the owning side to null (unless already changed)
            if ($catCalendarioCab->getClitipo() === $this) {
                $catCalendarioCab->setClitipo(null);
            }
        }

        return $this;
    }
}
