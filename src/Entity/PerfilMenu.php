<?php

namespace App\Entity;

use App\Repository\PerfilMenuRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PerfilMenuRepository::class)]
class PerfilMenu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'perfilMenus')]
    private ?Perfil $perfilid = null;

    #[ORM\ManyToOne(inversedBy: 'perfilMenus')]
    private ?Menu $menuid = null;

    #[ORM\Column]
    private ?bool $crear = null;

    #[ORM\Column]
    private ?bool $editar = null;

    #[ORM\Column]
    private ?bool $eliminar = null;

    #[ORM\Column]
    private ?bool $listar = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMenuid(): ?Menu
    {
        return $this->menuid;
    }

    public function setMenuid(?Menu $menuid): static
    {
        $this->menuid = $menuid;

        return $this;
    }

    public function isCrear(): ?bool
    {
        return $this->crear;
    }

    public function setCrear(bool $crear): static
    {
        $this->crear = $crear;

        return $this;
    }

    public function isEditar(): ?bool
    {
        return $this->editar;
    }

    public function setEditar(bool $editar): static
    {
        $this->editar = $editar;

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

    public function isListar(): ?bool
    {
        return $this->listar;
    }

    public function setListar(bool $listar): static
    {
        $this->listar = $listar;

        return $this;
    }
}
