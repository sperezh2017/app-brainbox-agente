<?php

namespace App\Entity;

use App\Repository\ProcesoLogsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProcesoLogsRepository::class)]
class ProcesoLogs
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

    #[ORM\Column]
    private ?bool $eliminar = null;

    #[ORM\Column]
    private ?int $diasemana = null;

    #[ORM\Column]
    private ?bool $despues = null;

    #[ORM\Column]
    private ?bool $habFin = null;

    #[ORM\ManyToOne(inversedBy: 'procesoLogs')]
    private ?CatProceso $proceso = null;

    #[ORM\ManyToOne(inversedBy: 'procesoLogs')]
    private ?Usuario $usuCreate = null;

    #[ORM\ManyToOne(inversedBy: 'procesoLogs')]
    private ?Usuario $usuUpdate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fechaCreate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fechaUpdate = null;

    #[ORM\ManyToOne(inversedBy: 'procesoLogs')]
    private ?TipoProceso $tipoProceso = null;

    #[ORM\ManyToOne(inversedBy: 'procesoLogs')]
    private ?VariableInicio $variableInicio = null;


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
    
    public function isEliminar(): ?bool
    {
        return $this->eliminar;
    }

    public function setEliminar(bool $eliminar): static
    {
        $this->eliminar = $eliminar;

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

    public function getProceso(): ?CatProceso
    {
        return $this->proceso;
    }

    public function setProceso(?CatProceso $proceso): static
    {
        $this->proceso = $proceso;

        return $this;
    }

    public function getUsuCreate(): ?Usuario
    {
        return $this->usuCreate;
    }

    public function setUsuCreate(?Usuario $usuCreate): static
    {
        $this->usuCreate = $usuCreate;

        return $this;
    }

    public function getUsuUpdate(): ?Usuario
    {
        return $this->usuUpdate;
    }

    public function setUsuUpdate(?Usuario $usuUpdate): static
    {
        $this->usuUpdate = $usuUpdate;

        return $this;
    }

    public function getFechaCreate(): ?\DateTimeInterface
    {
        return $this->fechaCreate;
    }

    public function setFechaCreate(\DateTimeInterface $fechaCreate): static
    {
        $this->fechaCreate = $fechaCreate;

        return $this;
    }

    public function getFechaUpdate(): ?\DateTimeInterface
    {
        return $this->fechaUpdate;
    }

    public function setFechaUpdate(\DateTimeInterface $fechaUpdate): static
    {
        $this->fechaUpdate = $fechaUpdate;

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
}
