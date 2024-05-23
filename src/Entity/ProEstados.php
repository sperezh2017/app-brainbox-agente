<?php

namespace App\Entity;

use App\Repository\ProEstadosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProEstadosRepository::class)]
class ProEstados
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $descripcion = null;

    #[ORM\Column]
    private ?bool $defectoNuevo = null;

    #[ORM\OneToMany(mappedBy: 'estado', targetEntity: ProTransaccion::class)]
    private Collection $proTransaccions;

    public function __construct()
    {
        $this->proTransaccions = new ArrayCollection();
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

    public function isDefectoNuevo(): ?bool
    {
        return $this->defectoNuevo;
    }

    public function setDefectoNuevo(bool $defectoNuevo): static
    {
        $this->defectoNuevo = $defectoNuevo;

        return $this;
    }

    /**
     * @return Collection<int, ProTransaccion>
     */
    public function getProTransaccions(): Collection
    {
        return $this->proTransaccions;
    }

    public function addProTransaccion(ProTransaccion $proTransaccion): static
    {
        if (!$this->proTransaccions->contains($proTransaccion)) {
            $this->proTransaccions->add($proTransaccion);
            $proTransaccion->setEstado($this);
        }

        return $this;
    }

    public function removeProTransaccion(ProTransaccion $proTransaccion): static
    {
        if ($this->proTransaccions->removeElement($proTransaccion)) {
            // set the owning side to null (unless already changed)
            if ($proTransaccion->getEstado() === $this) {
                $proTransaccion->setEstado(null);
            }
        }

        return $this;
    }
}
