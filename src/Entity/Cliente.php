<?php

namespace App\Entity;

use App\Repository\ClienteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClienteRepository::class)]
class Cliente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'clientes')]
    private ?TipoDocIdent $tipdoc = null;

    #[ORM\Column(length: 100)]
    private ?string $documento = null;

    #[ORM\Column(length: 100)]
    private ?string $razonsocial = null;

    #[ORM\Column(length: 100)]
    private ?string $email = null;

    #[ORM\Column(length: 15)]
    private ?string $telefono = null;

    #[ORM\ManyToOne(inversedBy: 'clientes')]
    private ?Usuario $agente = null;

    #[ORM\ManyToOne(inversedBy: 'clientes')]
    private ?Ciudad $ciudad = null;

    #[ORM\Column(length: 255)]
    private ?string $direccion = null;

    #[ORM\Column]
    private ?bool $inactivo = null;

    #[ORM\OneToMany(mappedBy: 'cliente', targetEntity: Tarea::class)]
    private Collection $tareas;

    #[ORM\Column]
    private ?bool $eliminar = null;

    #[ORM\OneToMany(mappedBy: 'cliente', targetEntity: CliContactos::class)]
    private Collection $cliContactos;

    #[ORM\ManyToOne(inversedBy: 'clientes')]
    private ?CliTemplate $template = null;

    #[ORM\OneToMany(mappedBy: 'cliente', targetEntity: ClienteProceso::class)]
    private Collection $clienteProcesos;

    #[ORM\Column]
    private ?bool $regimen = null;

    #[ORM\ManyToOne(inversedBy: 'clientes')]
    private ?CliTipo $CliTipo = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateIn = null;

    #[ORM\OneToMany(mappedBy: 'cliente', targetEntity: CliNotas::class)]
    private Collection $cliNotas;

    #[ORM\Column]
    private ?int $frecuenciaIva = null;

    #[ORM\OneToMany(mappedBy: 'cliente', targetEntity: ProTransaccion::class)]
    private Collection $proTransaccions;

    public function __construct()
    {
        $this->tareas = new ArrayCollection();
        $this->cliContactos = new ArrayCollection();
        $this->clienteProcesos = new ArrayCollection();
        $this->cliNotas = new ArrayCollection();
        $this->proTransaccions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRazonsocial(): ?string
    {
        return $this->razonsocial;
    }

    public function setRazonsocial(string $razonsocial): static
    {
        $this->razonsocial = $razonsocial;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): static
    {
        $this->telefono = $telefono;

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

    /**
     * @return Collection<int, Tarea>
     */
    public function getTareas(): Collection
    {
        return $this->tareas;
    }

    public function addTarea(Tarea $tarea): static
    {
        if (!$this->tareas->contains($tarea)) {
            $this->tareas->add($tarea);
            $tarea->setCliente($this);
        }

        return $this;
    }

    public function removeTarea(Tarea $tarea): static
    {
        if ($this->tareas->removeElement($tarea)) {
            // set the owning side to null (unless already changed)
            if ($tarea->getCliente() === $this) {
                $tarea->setCliente(null);
            }
        }

        return $this;
    }

    public function getCiudad(): ?Ciudad
    {
        return $this->ciudad;
    }

    public function setCiudad(?Ciudad $ciudad): static
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): static
    {
        $this->direccion = $direccion;

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

    public function getTipdoc(): ?TipoDocIdent
    {
        return $this->tipdoc;
    }

    public function setTipdoc(?TipoDocIdent $tipdoc): static
    {
        $this->tipdoc = $tipdoc;

        return $this;
    }

    public function getDocumento(): ?string
    {
        return $this->documento;
    }

    public function setDocumento(string $documento): static
    {
        $this->documento = $documento;

        return $this;
    }

    public function getAgente(): ?Usuario
    {
        return $this->agente;
    }

    public function setAgente(?Usuario $agente): static
    {
        $this->agente = $agente;

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

    /**
     * @return Collection<int, CliContactos>
     */
    public function getCliContactos(): Collection
    {
        return $this->cliContactos;
    }

    public function addCliContacto(CliContactos $cliContacto): static
    {
        if (!$this->cliContactos->contains($cliContacto)) {
            $this->cliContactos->add($cliContacto);
            $cliContacto->setCliente($this);
        }

        return $this;
    }

    public function removeCliContacto(CliContactos $cliContacto): static
    {
        if ($this->cliContactos->removeElement($cliContacto)) {
            // set the owning side to null (unless already changed)
            if ($cliContacto->getCliente() === $this) {
                $cliContacto->setCliente(null);
            }
        }

        return $this;
    }

    public function getTemplate(): ?CliTemplate
    {
        return $this->template;
    }

    public function setTemplate(?CliTemplate $template): static
    {
        $this->template = $template;

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
            $clienteProceso->setCliente($this);
        }

        return $this;
    }

    public function removeClienteProceso(ClienteProceso $clienteProceso): static
    {
        if ($this->clienteProcesos->removeElement($clienteProceso)) {
            // set the owning side to null (unless already changed)
            if ($clienteProceso->getCliente() === $this) {
                $clienteProceso->setCliente(null);
            }
        }

        return $this;
    }

    public function isRegimen(): ?bool
    {
        return $this->regimen;
    }

    public function setRegimen(bool $regimen): static
    {
        $this->regimen = $regimen;

        return $this;
    }

    public function getCliTipo(): ?CliTipo
    {
        return $this->CliTipo;
    }

    public function setCliTipo(?CliTipo $CliTipo): static
    {
        $this->CliTipo = $CliTipo;

        return $this;
    }

    public function getDateIn(): ?\DateTimeInterface
    {
        return $this->dateIn;
    }

    public function setDateIn(\DateTimeInterface $dateIn): static
    {
        $this->dateIn = $dateIn;

        return $this;
    }

    /**
     * @return Collection<int, CliNotas>
     */
    public function getCliNotas(): Collection
    {
        return $this->cliNotas;
    }

    public function addCliNota(CliNotas $cliNota): static
    {
        if (!$this->cliNotas->contains($cliNota)) {
            $this->cliNotas->add($cliNota);
            $cliNota->setCliente($this);
        }

        return $this;
    }

    public function removeCliNota(CliNotas $cliNota): static
    {
        if ($this->cliNotas->removeElement($cliNota)) {
            // set the owning side to null (unless already changed)
            if ($cliNota->getCliente() === $this) {
                $cliNota->setCliente(null);
            }
        }

        return $this;
    }

    public function getFrecuenciaIva(): ?int
    {
        return $this->frecuenciaIva;
    }

    public function setFrecuenciaIva(int $frecuenciaIva): static
    {
        $this->frecuenciaIva = $frecuenciaIva;
        return $this;
    }

    /**
     * @return Collection<int, ProTransaccion>
     */
    public function getProTransaccions(): Collection
    {
        return $this->proTransaccions;
    }

    public function addProTransaccion(ProTransaccion $proTransaccion): static
    {
        if (!$this->proTransaccions->contains($proTransaccion)) {
            $this->proTransaccions->add($proTransaccion);
            $proTransaccion->setCliente($this);
        }

        return $this;
    }

    public function removeProTransaccion(ProTransaccion $proTransaccion): static
    {
        if ($this->proTransaccions->removeElement($proTransaccion)) {
            // set the owning side to null (unless already changed)
            if ($proTransaccion->getCliente() === $this) {
                $proTransaccion->setCliente(null);
            }
        }

        return $this;
    }
}
