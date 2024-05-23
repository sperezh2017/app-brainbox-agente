<?php

namespace App\Entity;

use App\Repository\CatCalendarioCabRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CatCalendarioCabRepository::class)]
class CatCalendarioCab
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $descripcion = null;

    #[ORM\OneToMany(mappedBy: 'catCalendario', targetEntity: CalendarioSri::class)]
    private Collection $calendarioSris;

    #[ORM\Column]
    private ?bool $inactivo = null;

    #[ORM\Column]
    private ?bool $eliminar = null;

    #[ORM\OneToMany(mappedBy: 'catCalendario', targetEntity: CatProceso::class)]
    private Collection $catProcesos;

    #[ORM\ManyToOne(inversedBy: 'catCalendarioCabs')]
    private ?CatRecurrencia $recurrencia = null;

    public function __construct()
    {
        $this->calendarioSris = new ArrayCollection();
        $this->catProcesos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): static
    {
        $this->descripcion = $descripcion;

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
            $calendarioSri->setCatCalendario($this);
        }

        return $this;
    }

    public function removeCalendarioSri(CalendarioSri $calendarioSri): static
    {
        if ($this->calendarioSris->removeElement($calendarioSri)) {
            // set the owning side to null (unless already changed)
            if ($calendarioSri->getCatCalendario() === $this) {
                $calendarioSri->setCatCalendario(null);
            }
        }

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
            $catProceso->setCatCalendario($this);
        }

        return $this;
    }

    public function removeCatProceso(CatProceso $catProceso): static
    {
        if ($this->catProcesos->removeElement($catProceso)) {
            // set the owning side to null (unless already changed)
            if ($catProceso->getCatCalendario() === $this) {
                $catProceso->setCatCalendario(null);
            }
        }

        return $this;
    }

    public function getRecurrencia(): ?CatRecurrencia
    {
        return $this->recurrencia;
    }

    public function setRecurrencia(?CatRecurrencia $recurrencia): static
    {
        $this->recurrencia = $recurrencia;

        return $this;
    }
}
