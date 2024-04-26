<?php

namespace App\Entity;

use App\Repository\EstudianteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EstudianteRepository::class)]
class Estudiante extends Persona
{
    #[ORM\Column]
    private ?int $nie = null;

    #[ORM\Column(type: Types::BLOB)]
    private $foto = null;

    public function getNie(): ?int
    {
        return $this->nie;
    }

    public function setNie(int $nie): static
    {
        $this->nie = $nie;

        return $this;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function setFoto($foto): static
    {
        $this->foto = $foto;

        return $this;
    }
}
