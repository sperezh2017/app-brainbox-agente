<?php

namespace App\Entity;

use App\Repository\CliNotasRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CliNotasRepository::class)]
class CliNotas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $nota = null;

    #[ORM\ManyToOne(inversedBy: 'cliNotas')]
    private ?Usuario $usuCreate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fechaCreate = null;

    #[ORM\ManyToOne(inversedBy: 'cliNotas')]
    private ?Usuario $usuUpdate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fechaUpdate = null;

    #[ORM\ManyToOne(inversedBy: 'cliNotas')]
    private ?Cliente $cliente = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNota(): ?string
    {
        return $this->nota;
    }

    public function setNota(string $nota): static
    {
        $this->nota = $nota;

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

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): static
    {
        $this->cliente = $cliente;

        return $this;
    }
}
