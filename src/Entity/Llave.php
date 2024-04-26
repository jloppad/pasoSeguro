<?php

namespace App\Entity;

use App\Repository\LlaveRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LlaveRepository::class)]
class Llave
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $horaDejada = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $horaDevuelta = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHoraDejada(): ?\DateTimeInterface
    {
        return $this->horaDejada;
    }

    public function setHoraDejada(\DateTimeInterface $horaDejada): static
    {
        $this->horaDejada = $horaDejada;

        return $this;
    }

    public function getHoraDevuelta(): ?\DateTimeInterface
    {
        return $this->horaDevuelta;
    }

    public function setHoraDevuelta(\DateTimeInterface $horaDevuelta): static
    {
        $this->horaDevuelta = $horaDevuelta;

        return $this;
    }
}
