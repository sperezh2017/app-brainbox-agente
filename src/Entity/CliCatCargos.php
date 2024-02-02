<?php

namespace App\Entity;

use App\Repository\CliCatCargosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CliCatCargosRepository::class)]
class CliCatCargos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $clicargo = null;

    #[ORM\Column]
    private ?bool $inactivo = null;

    #[ORM\Column]
    private ?bool $eliminar = null;

    #[ORM\OneToMany(mappedBy: 'cargo', targetEntity: CliContactos::class)]
    private Collection $cliContactos;

    public function __construct()
    {
        $this->cliContactos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClicargo(): ?string
    {
        return $this->clicargo;
    }

    public function setClicargo(string $clicargo): static
    {
        $this->clicargo = $clicargo;

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
     * @return Collection<int, CliContactos>
     */
    public function getCliContactos(): Collection
    {
        return $this->cliContactos;
    }

    public function addCliContacto(CliContactos $cliContacto): static
    {
        if (!$this->cliContactos->contains($cliContacto)) {
            $this->cliContactos->add($cliContacto);
            $cliContacto->setCargo($this);
        }

        return $this;
    }

    public function removeCliContacto(CliContactos $cliContacto): static
    {
        if ($this->cliContactos->removeElement($cliContacto)) {
            // set the owning side to null (unless already changed)
            if ($cliContacto->getCargo() === $this) {
                $cliContacto->setCargo(null);
            }
        }

        return $this;
    }
}
