<?php

namespace App\Entity;

use App\Repository\CatProcesoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CatProcesoRepository::class)]
class CatProceso
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $prodescripcion = null;

    #[ORM\Column]
    private ?int $dia = null;

    #[ORM\ManyToOne(inversedBy: 'catProcesos')]
    private ?CatMes $mes = null;

    #[ORM\ManyToOne(inversedBy: 'catProcesos')]
    private ?CatRecurrencia $recurrencia = null;

    #[ORM\Column]
    private ?int $proantdias = null;

    #[ORM\ManyToOne(inversedBy: 'catProcesos')]
    private ?CatEntidad $entidad = null;

    #[ORM\Column]
    private ?bool $inactivo = null;

    #[ORM\OneToMany(mappedBy: 'proceso', targetEntity: CatSubProcesos::class)]
    private Collection $catSubProcesos;

    #[ORM\Column]
    private ?bool $eliminar = null;

    #[ORM\ManyToMany(targetEntity: CliTemplate::class, mappedBy: 'procesos')]
    private Collection $cliTemplates;

    #[ORM\OneToMany(mappedBy: 'proceso', targetEntity: ClienteProceso::class)]
    private Collection $clienteProcesos;

    #[ORM\ManyToMany(targetEntity: TipoGuia::class, mappedBy: 'procesos')]
    private Collection $tipoGuias;

    #[ORM\ManyToOne(inversedBy: 'catProcesos')]
    private ?TipoProceso $tipoProceso = null;

    #[ORM\ManyToOne(inversedBy: 'catProcesos')]
    private ?VariableInicio $variableInicio = null;

    #[ORM\Column]
    private ?int $diasemana = null;

    #[ORM\Column]
    private ?bool $despues = null;

    #[ORM\Column]
    private ?bool $habFin = null;

    public function __construct()
    {
        $this->catSubProcesos = new ArrayCollection();
        $this->cliTemplates = new ArrayCollection();
        $this->clienteProcesos = new ArrayCollection();
        $this->tipoGuias = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProdescripcion(): ?string
    {
        return $this->prodescripcion;
    }

    public function setProdescripcion(string $prodescripcion): static
    {
        $this->prodescripcion = $prodescripcion;

        return $this;
    }

    public function getDia(): ?int
    {
        return $this->dia;
    }

    public function setDia(int $dia): static
    {
        $this->dia = $dia;

        return $this;
    }

    public function getMes(): ?CatMes
    {
        return $this->mes;
    }

    public function setMes(?CatMes $mes): static
    {
        $this->mes = $mes;

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

    public function getProantdias(): ?int
    {
        return $this->proantdias;
    }

    public function setProantdias(int $proantdias): static
    {
        $this->proantdias = $proantdias;

        return $this;
    }

    public function getEntidad(): ?CatEntidad
    {
        return $this->entidad;
    }

    public function setEntidad(?CatEntidad $entidad): static
    {
        $this->entidad = $entidad;

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

    /**
     * @return Collection<int, CatSubProcesos>
     */
    public function getCatSubProcesos(): Collection
    {
        return $this->catSubProcesos;
    }

    public function addCatSubProceso(CatSubProcesos $catSubProceso): static
    {
        if (!$this->catSubProcesos->contains($catSubProceso)) {
            $this->catSubProcesos->add($catSubProceso);
            $catSubProceso->setProceso($this);
        }

        return $this;
    }

    public function removeCatSubProceso(CatSubProcesos $catSubProceso): static
    {
        if ($this->catSubProcesos->removeElement($catSubProceso)) {
            // set the owning side to null (unless already changed)
            if ($catSubProceso->getProceso() === $this) {
                $catSubProceso->setProceso(null);
            }
        }

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
     * @return Collection<int, CliTemplate>
     */
    public function getCliTemplates(): Collection
    {
        return $this->cliTemplates;
    }

    public function addCliTemplate(CliTemplate $cliTemplate): static
    {
        if (!$this->cliTemplates->contains($cliTemplate)) {
            $this->cliTemplates->add($cliTemplate);
            $cliTemplate->addProceso($this);
        }

        return $this;
    }

    public function removeCliTemplate(CliTemplate $cliTemplate): static
    {
        if ($this->cliTemplates->removeElement($cliTemplate)) {
            $cliTemplate->removeProceso($this);
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
            $clienteProceso->setProceso($this);
        }

        return $this;
    }

    public function removeClienteProceso(ClienteProceso $clienteProceso): static
    {
        if ($this->clienteProcesos->removeElement($clienteProceso)) {
            // set the owning side to null (unless already changed)
            if ($clienteProceso->getProceso() === $this) {
                $clienteProceso->setProceso(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TipoGuia>
     */
    public function getTipoGuias(): Collection
    {
        return $this->tipoGuias;
    }

    public function addTipoGuia(TipoGuia $tipoGuia): static
    {
        if (!$this->tipoGuias->contains($tipoGuia)) {
            $this->tipoGuias->add($tipoGuia);
            $tipoGuia->addProceso($this);
        }

        return $this;
    }

    public function removeTipoGuia(TipoGuia $tipoGuia): static
    {
        if ($this->tipoGuias->removeElement($tipoGuia)) {
            $tipoGuia->removeProceso($this);
        }

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

    public function getVariableInicio(): ?VariableInicio
    {
        return $this->variableInicio;
    }

    public function setVariableInicio(?VariableInicio $variableInicio): static
    {
        $this->variableInicio = $variableInicio;

        return $this;
    }

    public function getDiasemana(): ?int
    {
        return $this->diasemana;
    }

    public function setDiasemana(int $diasemana): static
    {
        $this->diasemana = $diasemana;

        return $this;
    }

    public function isDespues(): ?bool
    {
        return $this->despues;
    }

    public function setDespues(bool $despues): static
    {
        $this->despues = $despues;

        return $this;
    }

    public function isHabFin(): ?bool
    {
        return $this->habFin;
    }

    public function setHabFin(bool $habFin): static
    {
        $this->habFin = $habFin;

        return $this;
    }
}
