<?php

namespace App\Entity;

use App\Repository\ProTransaccionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProTransaccionRepository::class)]
class ProTransaccion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'proTransaccions')]
    private ?Cliente $cliente = null;

    #[ORM\ManyToOne(inversedBy: 'proTransaccions')]
    private ?CatProceso $proceso = null;

    #[ORM\Column(length: 100)]
    private ?string $procesoNombre = null;

    #[ORM\ManyToOne(inversedBy: 'proTransaccions')]
    private ?ProEtiquetas $etiqueta = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fechaInicio = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $FechaVence = null;

    #[ORM\ManyToOne(inversedBy: 'proTransaccions')]
    private ?ProEstados $estado = null;

    #[ORM\ManyToOne(inversedBy: 'proTransaccions')]
    private ?Usuario $usuario = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): static
    {
        $this->cliente = $cliente;

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

    public function getProcesoNombre(): ?string
    {
        return $this->procesoNombre;
    }

    public function setProcesoNombre(string $procesoNombre): static
    {
        $this->procesoNombre = $procesoNombre;

        return $this;
    }

    public function getEtiqueta(): ?ProEtiquetas
    {
        return $this->etiqueta;
    }

    public function setEtiqueta(?ProEtiquetas $etiqueta): static
    {
        $this->etiqueta = $etiqueta;

        return $this;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(\DateTimeInterface $fechaInicio): static
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getFechaVence(): ?\DateTimeInterface
    {
        return $this->FechaVence;
    }

    public function setFechaVence(\DateTimeInterface $FechaVence): static
    {
        $this->FechaVence = $FechaVence;

        return $this;
    }

    public function getEstado(): ?ProEstados
    {
        return $this->estado;
    }

    public function setEstado(?ProEstados $estado): static
    {
        $this->estado = $estado;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): static
    {
        $this->usuario = $usuario;

        return $this;
    }
}
