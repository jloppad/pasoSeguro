<?php

namespace App\Entity;

use App\Repository\MotivoRepository;
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
}
