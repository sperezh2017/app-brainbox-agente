<?php

namespace App\Entity;

use App\Repository\EstFechaVencimientoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EstFechaVencimientoRepository::class)]
#[ORM\Table(name:"pro_fechas")]
class EstFechaVencimiento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, name: 'descripcion')]
    private ?string $concepto = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getConcepto(): ?string
    {
        return $this->concepto;
    }

    public function setConcepto(string $concepto): static
    {
        $this->concepto = $concepto;

        return $this;
    }
}
