<?php

namespace App\Entity;

use App\Repository\PerfilRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PerfilRepository::class)]
class Perfil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombperfil = null;

    #[ORM\OneToMany(mappedBy: 'perfilid', targetEntity: PerfilMenu::class)]
    private Collection $perfilMenus;

    #[ORM\OneToMany(mappedBy: 'perfilid', targetEntity: Usuario::class)]
    private Collection $usuarios;

    public function __construct()
    {
        $this->perfilMenus = new ArrayCollection();
        $this->usuarios = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombperfil(): ?string
    {
        return $this->nombperfil;
    }

    public function setNombperfil(string $nombperfil): static
    {
        $this->nombperfil = $nombperfil;

        return $this;
    }

    /**
     * @return Collection<int, PerfilMenu>
     */
    public function getPerfilMenus(): Collection
    {
        return $this->perfilMenus;
    }

    public function addPerfilMenu(PerfilMenu $perfilMenu): static
    {
        if (!$this->perfilMenus->contains($perfilMenu)) {
            $this->perfilMenus->add($perfilMenu);
            $perfilMenu->setPerfilid($this);
        }

        return $this;
    }

    public function removePerfilMenu(PerfilMenu $perfilMenu): static
    {
        if ($this->perfilMenus->removeElement($perfilMenu)) {
            // set the owning side to null (unless already changed)
            if ($perfilMenu->getPerfilid() === $this) {
                $perfilMenu->setPerfilid(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Usuario>
     */
    public function getUsuarios(): Collection
    {
        return $this->usuarios;
    }

    public function addUsuario(Usuario $usuario): static
    {
        if (!$this->usuarios->contains($usuario)) {
            $this->usuarios->add($usuario);
            $usuario->setPerfilid($this);
        }

        return $this;
    }

    public function removeUsuario(Usuario $usuario): static
    {
        if ($this->usuarios->removeElement($usuario)) {
            // set the owning side to null (unless already changed)
            if ($usuario->getPerfilid() === $this) {
                $usuario->setPerfilid(null);
            }
        }

        return $this;
    }
}
