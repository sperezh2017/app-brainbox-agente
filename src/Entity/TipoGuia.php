<?php

namespace App\Entity;

use App\Repository\TipoGuiaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TipoGuiaRepository::class)]
class TipoGuia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $guia = null;

    #[ORM\Column]
    private ?bool $inactivo = null;

    #[ORM\Column]
    private ?bool $eliminar = null;

    #[ORM\OneToMany(mappedBy: 'TipoGuia', targetEntity: CatGrupo::class)]
    private Collection $catGrupos;

    #[ORM\ManyToMany(targetEntity: CatProceso::class, inversedBy: 'tipoGuias')]
    private Collection $procesos;

    #[ORM\OneToMany(mappedBy: 'guia', targetEntity: ClienteProceso::class)]
    private Collection $clienteProcesos;

    public function __construct()
    {
        $this->catGrupos = new ArrayCollection();
        $this->procesos = new ArrayCollection();
        $this->clienteProcesos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGuia(): ?string
    {
        return $this->guia;
    }

    public function setGuia(string $guia): static
    {
        $this->guia = $guia;

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
     * @return Collection<int, CatGrupo>
     */
    public function getCatGrupos(): Collection
    {
        return $this->catGrupos;
    }

    public function addCatGrupo(CatGrupo $catGrupo): static
    {
        if (!$this->catGrupos->contains($catGrupo)) {
            $this->catGrupos->add($catGrupo);
            $catGrupo->setTipoguia($this);
        }

        return $this;
    }

    public function removeCatGrupo(CatGrupo $catGrupo): static
    {
        if ($this->catGrupos->removeElement($catGrupo)) {
            // set the owning side to null (unless already changed)
            if ($catGrupo->getTipoguia() === $this) {
                $catGrupo->setTipoguia(null);
            }
        }

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
            $clienteProceso->setGuia($this);
        }

        return $this;
    }

    public function removeClienteProceso(ClienteProceso $clienteProceso): static
    {
        if ($this->clienteProcesos->removeElement($clienteProceso)) {
            // set the owning side to null (unless already changed)
            if ($clienteProceso->getGuia() === $this) {
                $clienteProceso->setGuia(null);
            }
        }

        return $this;
    }
}
