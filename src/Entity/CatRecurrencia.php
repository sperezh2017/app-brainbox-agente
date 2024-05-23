<?php

namespace App\Entity;

use App\Repository\CatRecurrenciaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CatRecurrenciaRepository::class)]
class CatRecurrencia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $descripcion = null;

    #[ORM\OneToMany(mappedBy: 'recurrencia', targetEntity: CatProceso::class)]
    private Collection $catProcesos;

    #[ORM\Column]
    private ?bool $inactivo = null;

    #[ORM\Column]
    private ?bool $eliminar = null;

    #[ORM\Column]
    private ?bool $seleccion = null;

    #[ORM\OneToMany(mappedBy: 'recurrencia', targetEntity: CalendarioSri::class)]
    private Collection $calendarioSris;

    #[ORM\Column]
    private ?bool $noveno = null;

    #[ORM\OneToMany(mappedBy: 'recurrencia', targetEntity: CatCalendarioCab::class)]
    private Collection $catCalendarioCabs;

    public function __construct()
    {
        $this->catProcesos = new ArrayCollection();
        $this->calendarioSris = new ArrayCollection();
        $this->catCalendarioCabs = new ArrayCollection();
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
            $catProceso->setRecurrencia($this);
        }

        return $this;
    }

    public function removeCatProceso(CatProceso $catProceso): static
    {
        if ($this->catProcesos->removeElement($catProceso)) {
            // set the owning side to null (unless already changed)
            if ($catProceso->getRecurrencia() === $this) {
                $catProceso->setRecurrencia(null);
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

    public function isSeleccion(): ?bool
    {
        return $this->seleccion;
    }

    public function setSeleccion(bool $seleccion): static
    {
        $this->seleccion = $seleccion;

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
            $calendarioSri->setRecurrencia($this);
        }

        return $this;
    }

    public function removeCalendarioSri(CalendarioSri $calendarioSri): static
    {
        if ($this->calendarioSris->removeElement($calendarioSri)) {
            // set the owning side to null (unless already changed)
            if ($calendarioSri->getRecurrencia() === $this) {
                $calendarioSri->setRecurrencia(null);
            }
        }

        return $this;
    }

    public function isNoveno(): ?bool
    {
        return $this->noveno;
    }

    public function setNoveno(bool $noveno): static
    {
        $this->noveno = $noveno;

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
            $catCalendarioCab->setRecurrencia($this);
        }

        return $this;
    }

    public function removeCatCalendarioCab(CatCalendarioCab $catCalendarioCab): static
    {
        if ($this->catCalendarioCabs->removeElement($catCalendarioCab)) {
            // set the owning side to null (unless already changed)
            if ($catCalendarioCab->getRecurrencia() === $this) {
                $catCalendarioCab->setRecurrencia(null);
            }
        }

        return $this;
    }
}
