<?php

namespace App\Entity;

use App\Repository\VariableInicioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VariableInicioRepository::class)]
class VariableInicio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $variable = null;

    #[ORM\ManyToOne(inversedBy: 'variableInicios')]
    private ?TipoProceso $tipoProceso = null;

    #[ORM\OneToMany(mappedBy: 'variableInicio', targetEntity: CatProceso::class)]
    private Collection $catProcesos;

    #[ORM\OneToMany(mappedBy: 'variableInicio', targetEntity: ProcesoLogs::class)]
    private Collection $procesoLogs;

    public function __construct()
    {
        $this->catProcesos = new ArrayCollection();
        $this->procesoLogs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVariable(): ?string
    {
        return $this->variable;
    }

    public function setVariable(string $variable): static
    {
        $this->variable = $variable;

        return $this;
    }

    public function getTipoProceso(): ?TipoProceso
    {
        return $this->tipoProceso;
    }

    public function setTipoProceso(?TipoProceso $tipoProceso): static
    {
        $this->tipoProceso = $tipoProceso;

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
            $catProceso->setVariableInicio($this);
        }

        return $this;
    }

    public function removeCatProceso(CatProceso $catProceso): static
    {
        if ($this->catProcesos->removeElement($catProceso)) {
            // set the owning side to null (unless already changed)
            if ($catProceso->getVariableInicio() === $this) {
                $catProceso->setVariableInicio(null);
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
            $procesoLog->setVariableInicio($this);
        }

        return $this;
    }

    public function removeProcesoLog(ProcesoLogs $procesoLog): static
    {
        if ($this->procesoLogs->removeElement($procesoLog)) {
            // set the owning side to null (unless already changed)
            if ($procesoLog->getVariableInicio() === $this) {
                $procesoLog->setVariableInicio(null);
            }
        }

        return $this;
    }
}
