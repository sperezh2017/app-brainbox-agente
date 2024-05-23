<?php

namespace App\Entity;

use App\Repository\CalendarioSriRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CalendarioSriRepository::class)]
class CalendarioSri
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $digito = null;

    #[ORM\Column]
    private ?int $dia = null;

    #[ORM\Column]
    private ?bool $eliminar = null;

    #[ORM\ManyToOne(inversedBy: 'calendarioSris')]
    private ?CatMes $mes = null;

    #[ORM\ManyToOne(inversedBy: 'calendarioSris')]
    private ?CatCalendarioCab $catCalendario = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDigito(): ?int
    {
        return $this->digito;
    }

    public function setDigito(int $digito): static
    {
        $this->digito = $digito;

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

    public function isEliminar(): ?bool
    {
        return $this->eliminar;
    }

    public function setEliminar(bool $eliminar): static
    {
        $this->eliminar = $eliminar;

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

    public function getCatCalendario(): ?CatCalendarioCab
    {
        return $this->catCalendario;
    }

    public function setCatCalendario(?CatCalendarioCab $catCalendario): static
    {
        $this->catCalendario = $catCalendario;

        return $this;
    }
}
