<?php

namespace App\Entity;

use App\Repository\ClienteProcesoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClienteProcesoRepository::class)]
class ClienteProceso
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'clienteProcesos')]
    private ?Cliente $cliente = null;

    #[ORM\ManyToOne(inversedBy: 'clienteProcesos')]
    private ?CatProceso $proceso = null;

    #[ORM\ManyToOne(inversedBy: 'clienteProcesos')]
    private ?CatMes $mes = null;

    #[ORM\Column]
    private ?int $dia = null;

    #[ORM\Column]
    private ?int $proantdias = null;

    #[ORM\ManyToOne(inversedBy: 'clienteProcesos')]
    private ?CliContactos $contacto = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fechaeje = null;

    #[ORM\ManyToOne(inversedBy: 'clienteProcesos')]
    private ?TipoGuia $guia = null;

    #[ORM\ManyToOne(inversedBy: 'clienteProcesos')]
    private ?CatGrupo $familia = null;

    #[ORM\ManyToOne(inversedBy: 'clienteProcesos')]
    private ?CliTemplate $variable = null;

    #[ORM\Column]
    private ?int $diasemana = null;

    #[ORM\Column]
    private ?bool $despues = null;

    #[ORM\Column]
    private ?bool $habFin = null;

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

    public function getMes(): ?CatMes
    {
        return $this->mes;
    }

    public function setMes(?CatMes $mes): static
    {
        $this->mes = $mes;

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

    public function getProantdias(): ?int
    {
        return $this->proantdias;
    }

    public function setProantdias(int $proantdias): static
    {
        $this->proantdias = $proantdias;

        return $this;
    }

    public function getContacto(): ?CliContactos
    {
        return $this->contacto;
    }

    public function setContacto(?CliContactos $contacto): static
    {
        $this->contacto = $contacto;

        return $this;
    }

    public function getFechaeje(): ?\DateTimeInterface
    {
        return $this->fechaeje;
    }

    public function setFechaeje(\DateTimeInterface $fechaeje): static
    {
        $this->fechaeje = $fechaeje;

        return $this;
    }

    public function getGuia(): ?tipoguia
    {
        return $this->guia;
    }

    public function setGuia(?tipoguia $guia): static
    {
        $this->guia = $guia;

        return $this;
    }

    public function getFamilia(): ?CatGrupo
    {
        return $this->familia;
    }

    public function setFamilia(?CatGrupo $familia): static
    {
        $this->familia = $familia;

        return $this;
    }

    public function getVariable(): ?CliTemplate
    {
        return $this->variable;
    }

    public function setVariable(?CliTemplate $variable): static
    {
        $this->variable = $variable;

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
