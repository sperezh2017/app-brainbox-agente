<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nombmenu = null;

    #[ORM\OneToMany(mappedBy: 'menuid', targetEntity: PerfilMenu::class)]
    private Collection $perfilMenus;

    public function __construct()
    {
        $this->perfilMenus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombmenu(): ?string
    {
        return $this->nombmenu;
    }

    public function setNombmenu(string $nombmenu): static
    {
        $this->nombmenu = $nombmenu;

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
            $perfilMenu->setMenuid($this);
        }

        return $this;
    }

    public function removePerfilMenu(PerfilMenu $perfilMenu): static
    {
        if ($this->perfilMenus->removeElement($perfilMenu)) {
            // set the owning side to null (unless already changed)
            if ($perfilMenu->getMenuid() === $this) {
                $perfilMenu->setMenuid(null);
            }
        }

        return $this;
    }
}
