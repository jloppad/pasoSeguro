<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
class Usuario extends Persona
{
    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $pass = null;

    #[ORM\Column]
    private ?bool $esDocente = null;

    #[ORM\Column]
    private ?bool $esConserje = null;

    #[ORM\Column]
    private ?bool $esAdmin = null;

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): Usuario
    {
        $this->username = $username;
        return $this;
    }

    public function getPass(): ?string
    {
        return $this->pass;
    }

    public function setPass(string $pass): static
    {
        $this->pass = $pass;

        return $this;
    }

    public function isEsDocente(): ?bool
    {
        return $this->esDocente;
    }

    public function setEsDocente(bool $esDocente): static
    {
        $this->esDocente = $esDocente;

        return $this;
    }

    public function isEsConserje(): ?bool
    {
        return $this->esConserje;
    }

    public function setEsConserje(bool $esConserje): static
    {
        $this->esConserje = $esConserje;

        return $this;
    }

    public function isEsAdmin(): ?bool
    {
        return $this->esAdmin;
    }

    public function setEsAdmin(bool $esAdmin): static
    {
        $this->esAdmin = $esAdmin;

        return $this;
    }


}
