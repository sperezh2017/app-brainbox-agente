<?php

namespace App\Entity;

use App\Repository\CliTemplateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CliTemplateRepository::class)]
class CliTemplate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nombtemplate = null;

    #[ORM\Column]
    private ?bool $inactivo = null;

    #[ORM\Column]
    private ?bool $eliminar = null;

    #[ORM\ManyToMany(targetEntity: CatProceso::class, inversedBy: 'cliTemplates')]
    private Collection $procesos;

    #[ORM\OneToMany(mappedBy: 'template', targetEntity: Cliente::class)]
    private Collection $clientes;

    #[ORM\ManyToOne(inversedBy: 'cliTemplates')]
    private ?CatGrupo $grupo = null;

    #[ORM\OneToMany(mappedBy: 'variable', targetEntity: CliVariable::class)]
    private Collection $cliVariables;

    #[ORM\OneToMany(mappedBy: 'variable', targetEntity: CliVariableTemplate::class)]
    private Collection $cliVariableTemplates;

    #[ORM\OneToMany(mappedBy: 'variable', targetEntity: ClienteProceso::class)]
    private Collection $clienteProcesos;

    public function __construct()
    {
        $this->procesos = new ArrayCollection();
        $this->clientes = new ArrayCollection();
        $this->cliVariables = new ArrayCollection();
        $this->cliVariableTemplates = new ArrayCollection();
        $this->clienteProcesos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombtemplate(): ?string
    {
        return $this->nombtemplate;
    }

    public function setNombtemplate(string $nombtemplate): static
    {
        $this->nombtemplate = $nombtemplate;

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

    /**
     * @return Collection<int, CatProceso>
     */
    public function getProcesos(): Collection
    {
        return $this->procesos;
    }

    public function addProceso(CatProceso $proceso): static
    {
        if (!$this->procesos->contains($proceso)) {
            $this->procesos->add($proceso);
        }

        return $this;
    }

    public function removeProceso(CatProceso $proceso): static
    {
        $this->procesos->removeElement($proceso);

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
            $cliente->setTemplate($this);
        }

        return $this;
    }

    public function removeCliente(Cliente $cliente): static
    {
        if ($this->clientes->removeElement($cliente)) {
            // set the owning side to null (unless already changed)
            if ($cliente->getTemplate() === $this) {
                $cliente->setTemplate(null);
            }
        }

        return $this;
    }

    public function getGrupo(): ?CatGrupo
    {
        return $this->grupo;
    }

    public function setGrupo(?CatGrupo $grupo): static
    {
        $this->grupo = $grupo;

        return $this;
    }

    /**
     * @return Collection<int, CliVariable>
     */
    public function getCliVariables(): Collection
    {
        return $this->cliVariables;
    }

    public function addCliVariable(CliVariable $cliVariable): static
    {
        if (!$this->cliVariables->contains($cliVariable)) {
            $this->cliVariables->add($cliVariable);
            $cliVariable->setVariable($this);
        }

        return $this;
    }

    public function removeCliVariable(CliVariable $cliVariable): static
    {
        if ($this->cliVariables->removeElement($cliVariable)) {
            // set the owning side to null (unless already changed)
            if ($cliVariable->getVariable() === $this) {
                $cliVariable->setVariable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CliVariableTemplate>
     */
    public function getCliVariableTemplates(): Collection
    {
        return $this->cliVariableTemplates;
    }

    public function addCliVariableTemplate(CliVariableTemplate $cliVariableTemplate): static
    {
        if (!$this->cliVariableTemplates->contains($cliVariableTemplate)) {
            $this->cliVariableTemplates->add($cliVariableTemplate);
            $cliVariableTemplate->setVariable($this);
        }

        return $this;
    }

    public function removeCliVariableTemplate(CliVariableTemplate $cliVariableTemplate): static
    {
        if ($this->cliVariableTemplates->removeElement($cliVariableTemplate)) {
            // set the owning side to null (unless already changed)
            if ($cliVariableTemplate->getVariable() === $this) {
                $cliVariableTemplate->setVariable(null);
            }
        }

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
            $clienteProceso->setVariable($this);
        }

        return $this;
    }

    public function removeClienteProceso(ClienteProceso $clienteProceso): static
    {
        if ($this->clienteProcesos->removeElement($clienteProceso)) {
            // set the owning side to null (unless already changed)
            if ($clienteProceso->getVariable() === $this) {
                $clienteProceso->setVariable(null);
            }
        }

        return $this;
    }
}
