<?php

namespace App\Entity;

use App\Repository\CatSubProcesosRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CatSubProcesosRepository::class)]
class CatSubProcesos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $subproceso = null;

    #[ORM\ManyToOne(inversedBy: 'catSubProcesos')]
    private ?CatProceso $proceso = null;

    #[ORM\Column]
    private ?bool $inactivo = null;

    #[ORM\Column]
    private ?bool $eliminar = null;

    #[ORM\ManyToOne(inversedBy: 'catSubProcesos')]
    private ?Usuario $usuCreate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fechaCreate = null;

    #[ORM\ManyToOne(inversedBy: 'catSubProcesos')]
    private ?Usuario $usuUpdate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fechaUpdate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubproceso(): ?string
    {
        return $this->subproceso;
    }

    public function setSubproceso(string $subproceso): static
    {
        $this->subproceso = $subproceso;

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

    public function getUsuCreate(): ?Usuario
    {
        return $this->usuCreate;
    }

    public function setUsuCreate(?Usuario $usucreate): static
    {
        $this->usuCreate = $usucreate;

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

    public function getUsuUpdate(): ?Usuario
    {
        return $this->usuUpdate;
    }

    public function setUsuUpdate(?Usuario $usuUpdate): static
    {
        $this->usuUpdate = $usuUpdate;

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
}
