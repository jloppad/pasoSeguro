<?php

namespace App\Entity;

use App\Repository\PersonaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PersonaRepository::class)]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "tipo", type: "string")]
class Persona
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(
        message: "Por favor, introduce el nombre."
    )]
    #[Assert\Regex(
        pattern: '/^[^0-9]*$/',
        message: 'El nombre no debe contener números.'
    )]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(
        message: 'Por favor, introduce los apellidos.'
    )]
    #[Assert\Regex(
        pattern: '/^[^0-9]*$/',
        message: 'Los apellidos no deben contener números.'
    )]
    private ?string $apellidos = null;

    public function __toString(): string
    {
        return $this->getApellidos() . ", " . $this->getNombre();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): Persona
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(?string $apellidos): Persona
    {
        $this->apellidos = $apellidos;
        return $this;
    }





}