<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
class Usuario implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

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

    #[ORM\ManyToOne(inversedBy: 'usuarios')]
    private ?Perfil $perfilid = null;

    #[ORM\OneToMany(mappedBy: 'creador', targetEntity: Tarea::class)]
    private Collection $tareas;

    #[ORM\Column]
    private ?bool $inactivo = null;

    #[ORM\OneToMany(mappedBy: 'agente', targetEntity: Cliente::class)]
    private Collection $clientes;

    #[ORM\ManyToOne(inversedBy: 'usuarios')]
    private ?CatCargos $cargo = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'usuarios')]
    private ?self $usrsuper = null;

    #[ORM\OneToMany(mappedBy: 'usrsuper', targetEntity: self::class)]
    private Collection $usuarios;

    #[ORM\Column]
    private ?bool $eliminar = null;

    #[ORM\OneToMany(mappedBy: 'usucreate', targetEntity: CatSubProcesos::class)]
    private Collection $catSubProcesos;

    #[ORM\OneToMany(mappedBy: 'usuCreate', targetEntity: ProcesoLogs::class)]
    private Collection $procesoLogs;

    #[ORM\OneToMany(mappedBy: 'usuCreate', targetEntity: CatProceso::class)]
    private Collection $catProcesos;

    public function __construct()
    {
        $this->tareas = new ArrayCollection();
        $this->clientes = new ArrayCollection();
        $this->usuarios = new ArrayCollection();
        $this->catSubProcesos = new ArrayCollection();
        $this->procesoLogs = new ArrayCollection();
        $this->catProcesos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPrnombre(): ?string
    {
        return $this->prnombre;
    }

    public function setPrnombre(string $prnombre): static
    {
        $this->prnombre = $prnombre;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPerfilid(): ?Perfil
    {
        return $this->perfilid;
    }

    public function setPerfilid(?Perfil $perfilid): static
    {
        $this->perfilid = $perfilid;

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
            $tarea->setCreador($this);
        }

        return $this;
    }

    public function removeTarea(Tarea $tarea): static
    {
        if ($this->tareas->removeElement($tarea)) {
            // set the owning side to null (unless already changed)
            if ($tarea->getCreador() === $this) {
                $tarea->setCreador(null);
            }
        }

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
            $cliente->setAgente($this);
        }

        return $this;
    }

    public function removeCliente(Cliente $cliente): static
    {
        if ($this->clientes->removeElement($cliente)) {
            // set the owning side to null (unless already changed)
            if ($cliente->getAgente() === $this) {
                $cliente->setAgente(null);
            }
        }

        return $this;
    }

    public function getCargo(): ?CatCargos
    {
        return $this->cargo;
    }

    public function setCargo(?CatCargos $cargo): static
    {
        $this->cargo = $cargo;

        return $this;
    }

    public function getUsrsuper(): ?self
    {
        return $this->usrsuper;
    }

    public function setUsrsuper(?self $usrsuper): static
    {
        $this->usrsuper = $usrsuper;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getUsuarios(): Collection
    {
        return $this->usuarios;
    }

    public function addUsuario(self $usuario): static
    {
        if (!$this->usuarios->contains($usuario)) {
            $this->usuarios->add($usuario);
            $usuario->setUsrsuper($this);
        }

        return $this;
    }

    public function removeUsuario(self $usuario): static
    {
        if ($this->usuarios->removeElement($usuario)) {
            // set the owning side to null (unless already changed)
            if ($usuario->getUsrsuper() === $this) {
                $usuario->setUsrsuper(null);
            }
        }

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
     * @return Collection<int, CatSubProcesos>
     */
    public function getCatSubProcesos(): Collection
    {
        return $this->catSubProcesos;
    }

    public function addCatSubProceso(CatSubProcesos $catSubProceso): static
    {
        if (!$this->catSubProcesos->contains($catSubProceso)) {
            $this->catSubProcesos->add($catSubProceso);
            $catSubProceso->setUsucreate($this);
        }

        return $this;
    }

    public function removeCatSubProceso(CatSubProcesos $catSubProceso): static
    {
        if ($this->catSubProcesos->removeElement($catSubProceso)) {
            // set the owning side to null (unless already changed)
            if ($catSubProceso->getUsucreate() === $this) {
                $catSubProceso->setUsucreate(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProcesoLogs>
     */
    public function getProcesoLogs(): Collection
    {
        return $this->procesoLogs;
    }

    public function addProcesoLog(ProcesoLogs $procesoLog): static
    {
        if (!$this->procesoLogs->contains($procesoLog)) {
            $this->procesoLogs->add($procesoLog);
            $procesoLog->setUsuCreate($this);
        }

        return $this;
    }

    public function removeProcesoLog(ProcesoLogs $procesoLog): static
    {
        if ($this->procesoLogs->removeElement($procesoLog)) {
            // set the owning side to null (unless already changed)
            if ($procesoLog->getUsuCreate() === $this) {
                $procesoLog->setUsuCreate(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CatProceso>
     */
    public function getCatProcesos(): Collection
    {
        return $this->catProcesos;
    }

    public function addCatProceso(CatProceso $catProceso): static
    {
        if (!$this->catProcesos->contains($catProceso)) {
            $this->catProcesos->add($catProceso);
            $catProceso->setUsuCreate($this);
        }

        return $this;
    }

    public function removeCatProceso(CatProceso $catProceso): static
    {
        if ($this->catProcesos->removeElement($catProceso)) {
            // set the owning side to null (unless already changed)
            if ($catProceso->getUsuCreate() === $this) {
                $catProceso->setUsuCreate(null);
            }
        }

        return $this;
    }
}
