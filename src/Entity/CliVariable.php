<?php

namespace App\Entity;

use App\Repository\CliVariableRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CliVariableRepository::class)]
class CliVariable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

   #[ORM\Column(length: 100)]
    private ?string $template = null;

    #[ORM\Column]
    private ?bool $inactivo = null;

    #[ORM\OneToMany(mappedBy: 'template', targetEntity: CliVariableTemplate::class)]
    private Collection $cliVariableTemplates;

    #[ORM\Column]
    private ?bool $eliminar = null;

    public function __construct()
    {
        $this->cliVariableTemplates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTemplate(): ?string
    {
        return $this->template;
    }

    public function setTemplate(string $template): static
    {
        $this->template = $template;

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
            $cliVariableTemplate->setTemplate($this);
        }

        return $this;
    }

    public function removeCliVariableTemplate(CliVariableTemplate $cliVariableTemplate): static
    {
        if ($this->cliVariableTemplates->removeElement($cliVariableTemplate)) {
            // set the owning side to null (unless already changed)
            if ($cliVariableTemplate->getTemplate() === $this) {
                $cliVariableTemplate->setTemplate(null);
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
}
