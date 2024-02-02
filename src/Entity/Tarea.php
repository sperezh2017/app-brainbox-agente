<?php

namespace App\Entity;

use App\Repository\TareaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TareaRepository::class)]
class Tarea
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'tareas')]
    private ?Usuario $creador = null;

    #[ORM\ManyToOne(inversedBy: 'tareas')]
    private ?Cliente $cliente = null;

    #[ORM\ManyToOne(inversedBy: 'tareas')]
    private ?Usuario $usuario = null;

    #[ORM\Column(length: 150)]
    private ?string $titulo = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fechaini = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fechafin = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fechamod = null;

    #[ORM\OneToMany(mappedBy: 'tarea', targetEntity: DetalleTarea::class)]
    private Collection $detalleTareas;

    #[ORM\ManyToOne(inversedBy: 'tareas')]
    private ?EstadoTarea $estado = null;

    public function __construct()
    {
        $this->detalleTareas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreador(): ?usuario
    {
        return $this->creador;
    }

    public function setCreador(?usuario $creador): static
    {
        $this->creador = $creador;

        return $this;
    }

    public function getCliente(): ?cliente
    {
        return $this->cliente;
    }

    public function setCliente(?cliente $cliente): static
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function getUsuario(): ?usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?usuario $usuario): static
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): static
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getFechaini(): ?\DateTimeInterface
    {
        return $this->fechaini;
    }

    public function setFechaini(\DateTimeInterface $fechaini): static
    {
        $this->fechaini = $fechaini;

        return $this;
    }

    public function getFechafin(): ?\DateTimeInterface
    {
        return $this->fechafin;
    }

    public function setFechafin(\DateTimeInterface $fechafin): static
    {
        $this->fechafin = $fechafin;

        return $this;
    }

    public function getFechamod(): ?\DateTimeInterface
    {
        return $this->fechamod;
    }

    public function setFechamod(\DateTimeInterface $fechamod): static
    {
        $this->fechamod = $fechamod;

        return $this;
    }

    /**
     * @return Collection<int, DetalleTarea>
     */
    public function getDetalleTareas(): Collection
    {
        return $this->detalleTareas;
    }

    public function addDetalleTarea(DetalleTarea $detalleTarea): static
    {
        if (!$this->detalleTareas->contains($detalleTarea)) {
            $this->detalleTareas->add($detalleTarea);
            $detalleTarea->setTarea($this);
        }

        return $this;
    }

    public function removeDetalleTarea(DetalleTarea $detalleTarea): static
    {
        if ($this->detalleTareas->removeElement($detalleTarea)) {
            // set the owning side to null (unless already changed)
            if ($detalleTarea->getTarea() === $this) {
                $detalleTarea->setTarea(null);
            }
        }

        return $this;
    }

    public function getEstado(): ?EstadoTarea
    {
        return $this->estado;
    }

    public function setEstado(?EstadoTarea $estado): static
    {
        $this->estado = $estado;

        return $this;
    }
}
