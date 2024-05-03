<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
class Usuario extends Persona implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Column(unique: true)]
    private ?string $userName = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column]
    private ?bool $docente = null;

    #[ORM\Column]
    private ?bool $conserje = null;

    #[ORM\Column]
    private ?bool $admin = null;

    #[ORM\ManyToMany(targetEntity: Grupo::class, mappedBy: 'usuarios')]
    private Collection $grupos;

    #[ORM\OneToMany(targetEntity: Registro::class, mappedBy: 'responsable')]
    private Collection $registros;

    public function __construct()
    {
        $this->grupos = new ArrayCollection();
        $this->registros = new ArrayCollection();
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(?string $userName): Usuario
    {
        $this->userName = $userName;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function isDocente(): ?bool
    {
        return $this->docente;
    }

    public function setDocente(bool $docente): static
    {
        $this->docente = $docente;

        return $this;
    }

    public function isConserje(): ?bool
    {
        return $this->conserje;
    }

    public function setConserje(bool $conserje): static
    {
        $this->conserje = $conserje;

        return $this;
    }

    public function isAdmin(): ?bool
    {
        return $this->admin;
    }

    public function setAdmin(bool $admin): static
    {
        $this->admin = $admin;

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


    public function getRoles()
    {
        $roles = [];
        $roles[] = 'ROLE_USER';
        if ($this->isAdmin()) {
            $roles[] = 'ROLE_ADMIN';
        }
        if ($this->isDocente()) {
            $roles[] = 'ROLE_DOCENTE';
        }
        if ($this->isDocente()) {
            $roles[] = 'ROLE_CONSERJE';
        }
        return array_unique($roles);
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
        // Don't do anything
    }

    public function getUserIdentifier(): string
    {
        return $this->getUserName();
    }

}
