<?php

namespace App\Entity;

use App\Entity\Cliente;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CliVariableTemplateRepository;

#[ORM\Entity(repositoryClass: CliVariableTemplateRepository::class)]
class CliVariableTemplate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'cliVariableTemplates')]
    private ?CliTemplate $variable = null;

    #[ORM\ManyToOne(inversedBy: 'cliVariableTemplates')]
    private ?Cliente $cliente = null;

    #[ORM\Column]
    private ?bool $visible = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVariable(): ?CliTemplate
    {
        return $this->variable;
    }

    public function setVariable(?CliTemplate $variable): static
    {
        $this->variable = $variable;

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

    public function isVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): static
    {
        $this->visible = $visible;

        return $this;
    }
}
