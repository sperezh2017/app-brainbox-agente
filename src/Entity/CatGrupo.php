<?php

namespace App\Entity;

use App\Repository\CatGrupoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CatGrupoRepository::class)]
class CatGrupo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $grudescripcion = null;

    #[ORM\OneToMany(mappedBy: 'grupo', targetEntity: CatProceso::class)]
    private Collection $catProcesos;

    #[ORM\Column]
    private ?bool $inactivo = null;

    #[ORM\Column]
    private ?bool $eliminar = null;

    #[ORM\OneToMany(mappedBy: 'grupo', targetEntity: CliTemplate::class)]
    private Collection $cliTemplates;

    #[ORM\ManyToOne(inversedBy: 'catGrupos')]
    private ?TipoGuia $tipoguia = null;

    #[ORM\Column]
    private ?bool $excluyente = null;

    #[ORM\OneToMany(mappedBy: 'familia', targetEntity: ClienteProceso::class)]
    private Collection $clienteProcesos;

    public function __construct()
    {
        $this->catProcesos = new ArrayCollection();
        $this->cliTemplates = new ArrayCollection();
        $this->clienteProcesos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGrudescripcion(): ?string
    {
        return $this->grudescripcion;
    }

    public function setGrudescripcion(string $grudescripcion): static
    {
        $this->grudescripcion = $grudescripcion;

        return $this;
    }

    /**
     * @return Collection<int, CatProceso>
     */
    public function getCatProcesos(): Collection
    {
        return $this->catProcesos;
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
     * @return Collection<int, CliTemplate>
     */
    public function getCliTemplates(): Collection
    {
        return $this->cliTemplates;
    }

    public function addCliTemplate(CliTemplate $cliTemplate): static
    {
        if (!$this->cliTemplates->contains($cliTemplate)) {
            $this->cliTemplates->add($cliTemplate);
            $cliTemplate->setGrupo($this);
        }

        return $this;
    }

    public function removeCliTemplate(CliTemplate $cliTemplate): static
    {
        if ($this->cliTemplates->removeElement($cliTemplate)) {
            // set the owning side to null (unless already changed)
            if ($cliTemplate->getGrupo() === $this) {
                $cliTemplate->setGrupo(null);
            }
        }

        return $this;
    }

    public function getTipoguia(): ?TipoGuia
    {
        return $this->tipoguia;
    }

    public function setTipoguia(?TipoGuia $tipoguia): static
    {
        $this->tipoguia = $tipoguia;

        return $this;
    }

    public function isExcluyente(): ?bool
    {
        return $this->excluyente;
    }

    public function setExcluyente(bool $excluyente): static
    {
        $this->excluyente = $excluyente;

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
            $clienteProceso->setFamilia($this);
        }

        return $this;
    }

    public function removeClienteProceso(ClienteProceso $clienteProceso): static
    {
        if ($this->clienteProcesos->removeElement($clienteProceso)) {
            // set the owning side to null (unless already changed)
            if ($clienteProceso->getFamilia() === $this) {
                $clienteProceso->setFamilia(null);
            }
        }

        return $this;
    }
}
