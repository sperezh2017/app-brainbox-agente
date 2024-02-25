<?php

namespace App\Entity;

use App\Repository\TipoProcesoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TipoProcesoRepository::class)]
class TipoProceso
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $recurrencia = null;

    #[ORM\OneToMany(mappedBy: 'tipoProceso', targetEntity: CatProceso::class)]
    private Collection $catProcesos;

    #[ORM\OneToMany(mappedBy: 'tipoProceso', targetEntity: VariableInicio::class)]
    private Collection $variableInicios;

    #[ORM\OneToMany(mappedBy: 'tipoProceso', targetEntity: ProcesoLogs::class)]
    private Collection $procesoLogs;

    public function __construct()
    {
        $this->catProcesos = new ArrayCollection();
        $this->variableInicios = new ArrayCollection();
        $this->procesoLogs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecurrencia(): ?string
    {
        return $this->recurrencia;
    }

    public function setRecurrencia(string $recurrencia): static
    {
        $this->recurrencia = $recurrencia;

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
            $catProceso->setTipoProceso($this);
        }

        return $this;
    }

    public function removeCatProceso(CatProceso $catProceso): static
    {
        if ($this->catProcesos->removeElement($catProceso)) {
            // set the owning side to null (unless already changed)
            if ($catProceso->getTipoProceso() === $this) {
                $catProceso->setTipoProceso(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, VariableInicio>
     */
    public function getVariableInicios(): Collection
    {
        return $this->variableInicios;
    }

    public function addVariableInicio(VariableInicio $variableInicio): static
    {
        if (!$this->variableInicios->contains($variableInicio)) {
            $this->variableInicios->add($variableInicio);
            $variableInicio->setTipoProceso($this);
        }

        return $this;
    }

    public function removeVariableInicio(VariableInicio $variableInicio): static
    {
        if ($this->variableInicios->removeElement($variableInicio)) {
            // set the owning side to null (unless already changed)
            if ($variableInicio->getTipoProceso() === $this) {
                $variableInicio->setTipoProceso(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProcesoLogs>
     */
    public function getProcesoLogs(): Collection
    {
        return $this->procesoLogs;
    }

    public function addProcesoLog(ProcesoLogs $procesoLog): static
    {
        if (!$this->procesoLogs->contains($procesoLog)) {
            $this->procesoLogs->add($procesoLog);
            $procesoLog->setTipoProceso($this);
        }

        return $this;
    }

    public function removeProcesoLog(ProcesoLogs $procesoLog): static
    {
        if ($this->procesoLogs->removeElement($procesoLog)) {
            // set the owning side to null (unless already changed)
            if ($procesoLog->getTipoProceso() === $this) {
                $procesoLog->setTipoProceso(null);
            }
        }

        return $this;
    }
}
