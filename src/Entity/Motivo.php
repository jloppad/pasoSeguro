<?php

namespace App\Entity;

use App\Repository\MotivoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MotivoRepository::class)]
class Motivo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $descripcion = null;

    #[ORM\Column]
    private ?int $numeroOrden = null;

    #[ORM\ManyToMany(targetEntity: Registro::class, mappedBy: 'motivos')]
    private Collection $registros;

    public function __construct()
    {
        $this->registros = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getDescripcion();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getNumeroOrden(): ?int
    {
        return $this->numeroOrden;
    }

    public function setNumeroOrden(int $numeroOrden): static
    {
        $this->numeroOrden = $numeroOrden;

        return $this;
    }

    /**
     * @return Collection<int, Registro>
     */
    public function getRegistros(): Collection
    {
        return $this->registros;
    }

    public function addRegistro(Registro $registro): static
    {
        if (!$this->registros->contains($registro)) {
            $this->registros->add($registro);
            $registro->addMotivo($this);
        }

        return $this;
    }

    public function removeRegistro(Registro $registro): static
    {
        if ($this->registros->removeElement($registro)) {
            $registro->removeMotivo($this);
        }

        return $this;
    }
}
