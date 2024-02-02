<?php

namespace App\Entity;

use App\Repository\CiudadRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CiudadRepository::class)]
class Ciudad
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $cinombre = null;

    #[ORM\OneToMany(mappedBy: 'ciudad', targetEntity: Cliente::class)]
    private Collection $clientes;

    public function __construct()
    {
        $this->clientes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCinombre(): ?string
    {
        return $this->cinombre;
    }

    public function setCinombre(string $cinombre): static
    {
        $this->cinombre = $cinombre;

        return $this;
    }

    /**
     * @return Collection<int, Cliente>
     */
    public function getClientes(): Collection
    {
        return $this->clientes;
    }

    public function addCliente(Cliente $cliente): static
    {
        if (!$this->clientes->contains($cliente)) {
            $this->clientes->add($cliente);
            $cliente->setCiudad($this);
        }

        return $this;
    }

    public function removeCliente(Cliente $cliente): static
    {
        if ($this->clientes->removeElement($cliente)) {
            // set the owning side to null (unless already changed)
            if ($cliente->getCiudad() === $this) {
                $cliente->setCiudad(null);
            }
        }

        return $this;
    }
}
