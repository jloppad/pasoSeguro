<?php

namespace App\Entity;

use App\Repository\GrupoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GrupoRepository::class)]
class Grupo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $descripcion = null;

    #[ORM\ManyToOne(inversedBy: 'grupos')]
    private ?CursoAcademico $cursoAcademico = null;

    #[ORM\ManyToMany(targetEntity: Usuario::class, inversedBy: 'grupos')]
    private Collection $docentes;

    #[ORM\ManyToMany(targetEntity: Estudiante::class, inversedBy: 'grupos')]
    private Collection $estudiantes;

    #[ORM\OneToMany(targetEntity: Registro::class, mappedBy: 'grupo')]
    private Collection $registros;

    public function __construct()
    {
        $this->docentes = new ArrayCollection();
        $this->estudiantes = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->descripcion;
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

    public function getCursoAcademico(): ?CursoAcademico
    {
        return $this->cursoAcademico;
    }

    public function setCursoAcademico(?CursoAcademico $cursoAcademico): static
    {
        $this->cursoAcademico = $cursoAcademico;

        return $this;
    }

    public function getRegistros(): Collection
    {
        return $this->registros;
    }

    public function setRegistros(Collection $registros): void
    {
        $this->registros = $registros;
    }


    /**
     * @return Collection<int, Usuario>
     */
    public function getDocentes(): Collection
    {
        return $this->docentes;
    }

    public function addDocente(Usuario $usuario): static
    {
        if (!$this->docentes->contains($usuario)) {
            $this->docentes->add($usuario);
            $usuario->addGrupo($this);
        }

        return $this;
    }

    public function removeDocente(Usuario $usuario): static
    {
        if ($this->docentes->removeElement($usuario)) {
            $usuario->removeGrupo($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Estudiante>
     */
    public function getEstudiantes(): Collection
    {
        return $this->estudiantes;
    }

    public function addEstudiante(Estudiante $estudiante): static
    {
        if (!$this->estudiantes->contains($estudiante)) {
            $this->estudiantes->add($estudiante);
        }

        return $this;
    }

    public function removeEstudiante(Estudiante $estudiante): static
    {
        $this->estudiantes->removeElement($estudiante);

        return $this;
    }
}
