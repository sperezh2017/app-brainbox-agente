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
    private ?int $diasoc = null;

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

    public function getDiasoc(): ?int
    {
        return $this->diasoc;
    }

    public function setDiasoc(int $diasoc): static
    {
        $this->diasoc = $diasoc;

        return $this;
    }
}
