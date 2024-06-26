<?php

namespace App\Entity;

use App\Repository\EstudianteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EstudianteRepository::class)]
class Estudiante extends Persona
{
    #[ORM\Column]
    #[Assert\NotBlank(message: 'Por favor, introduce el NIE.')]
    #[Assert\Range(
        notInRangeMessage: 'El NIE debe tener entre 6 y 7 dígitos.',
        min: 100000,
        max: 9999999
    )]
    private ?int $nie = null;

    #[ORM\Column(type: 'blob', nullable: true)]
    /**
     * @var resource|null $foto
     */
    private $foto = null;

    #[ORM\ManyToMany(targetEntity: Grupo::class, mappedBy: 'estudiantes')]
    private Collection $grupos;

    #[ORM\OneToMany(targetEntity: Registro::class, mappedBy: 'estudiante')]
    private Collection $registros;

    public function __construct()
    {
        $this->grupos = new ArrayCollection();
        $this->registros = new ArrayCollection();
    }

    public function __toString(): string
    {
        return parent::__toString();
    }

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

    public function setFoto($foto): Estudiante
    {
        $this->foto = $foto;

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
            $grupo->addEstudiante($this);
        }

        return $this;
    }

    public function removeGrupo(Grupo $grupo): static
    {
        if ($this->grupos->removeElement($grupo)) {
            $grupo->removeEstudiante($this);
        }

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
            $registro->setEstudiante($this);
        }

        return $this;
    }

    public function removeRegistro(Registro $registro): static
    {
        if ($this->registros->removeElement($registro)) {
            // set the owning side to null (unless already changed)
            if ($registro->getEstudiante() === $this) {
                $registro->setEstudiante(null);
            }
        }

        return $this;
    }
}
