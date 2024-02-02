<?php

namespace App\Entity;

use App\Repository\CliContactosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CliContactosRepository::class)]
class CliContactos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $prnombre = null;

    #[ORM\Column(length: 100)]
    private ?string $segnombre = null;

    #[ORM\Column(length: 100)]
    private ?string $prapellido = null;

    #[ORM\Column(length: 100)]
    private ?string $segapellido = null;
    
    #[ORM\Column(length: 100)]
    private ?string $email = null;

    #[ORM\Column(length: 10)]
    private ?string $celular = null;

    #[ORM\Column(length: 100)]
    private ?string $clave = null;

    #[ORM\Column]
    private ?bool $inactivo = null;

    #[ORM\Column]
    private ?bool $eliminar = null;

    #[ORM\ManyToOne(inversedBy: 'cliContactos')]
    private ?Cliente $cliente = null;

    #[ORM\ManyToOne(inversedBy: 'cliContactos')]
    private ?CliCatCargos $cargo = null;

    #[ORM\OneToMany(mappedBy: 'contacto', targetEntity: ClienteProceso::class)]
    private Collection $clienteProcesos;

    public function __construct()
    {
        $this->clienteProcesos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrnombre(): ?string
    {
        return $this->prnombre;
    }

    public function sePrnombre(string $prnombre): static
    {
        $this->prnombre = $prnombre;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getCelular(): ?string
    {
        return $this->celular;
    }

    public function setCelular(string $celular): static
    {
        $this->celular = $celular;

        return $this;
    }

    public function getClave(): ?string
    {
        return $this->clave;
    }

    public function setClave(string $clave): static
    {
        $this->clave = $clave;

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

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): static
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function getCargo(): ?CliCatCargos
    {
        return $this->cargo;
    }

    public function setCargo(?CliCatCargos $cargo): static
    {
        $this->cargo = $cargo;

        return $this;
    }

    public function getSegnombre(): ?string
    {
        return $this->segnombre;
    }

    public function setSegnombre(string $segnombre): static
    {
        $this->segnombre = $segnombre;

        return $this;
    }

    public function getPrapellido(): ?string
    {
        return $this->prapellido;
    }

    public function setPrapellido(string $prapellido): static
    {
        $this->prapellido = $prapellido;

        return $this;
    }

    public function getSegapellido(): ?string
    {
        return $this->segapellido;
    }

    public function setSegapellido(string $segapellido): static
    {
        $this->segapellido = $segapellido;

        return $this;
    }

    /**
     * @return Collection<int, ClienteProceso>
     */
    public function getClienteProcesos(): Collection
    {
        return $this->clienteProcesos;
    }

    public function addClienteProceso(ClienteProceso $clienteProceso): static
    {
        if (!$this->clienteProcesos->contains($clienteProceso)) {
            $this->clienteProcesos->add($clienteProceso);
            $clienteProceso->setContacto($this);
        }

        return $this;
    }

    public function removeClienteProceso(ClienteProceso $clienteProceso): static
    {
        if ($this->clienteProcesos->removeElement($clienteProceso)) {
            // set the owning side to null (unless already changed)
            if ($clienteProceso->getContacto() === $this) {
                $clienteProceso->setContacto(null);
            }
        }

        return $this;
    }
}
