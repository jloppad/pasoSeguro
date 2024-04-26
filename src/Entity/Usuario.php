<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\ManyToMany(targetEntity: Grupo::class, mappedBy: 'usuarios')]
    private Collection $grupos;

    #[ORM\OneToMany(targetEntity: Registro::class, mappedBy: 'responsable')]
    private Collection $registros;

    public function __construct()
    {
        $this->grupos = new ArrayCollection();
        $this->registros = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Grupo>
     */
    public function getGrupos(): Collection
    {
        return $this->grupos;
    }

    public function addGrupo(Grupo $grupo): static
    {
        if (!$this->grupos->contains($grupo)) {
            $this->grupos->add($grupo);
        }

        return $this;
    }

    public function removeGrupo(Grupo $grupo): static
    {
        $this->grupos->removeElement($grupo);

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
            $registro->setResponsable($this);
        }

        return $this;
    }

    public function removeRegistro(Registro $registro): static
    {
        if ($this->registros->removeElement($registro)) {
            // set the owning side to null (unless already changed)
            if ($registro->getResponsable() === $this) {
                $registro->setResponsable(null);
            }
        }

        return $this;
    }


}
