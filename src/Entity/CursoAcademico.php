<?php

namespace App\Entity;

use App\Repository\CursoAcademicoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CursoAcademicoRepository::class)]
class CursoAcademico
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $descripcion = null;

    #[ORM\Column(type: 'date')]
    private ?\DateTimeInterface $fechaInicio = null;

    #[ORM\Column(type: 'date')]
    private ?\DateTimeInterface $fechaFinal = null;

    #[ORM\OneToMany(targetEntity: Grupo::class, mappedBy: 'cursoAcademico')]
    private Collection $grupos;

    public function __construct()
    {
        $this->grupos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(\DateTimeInterface $fechaInicio): self
    {
        $this->fechaInicio = $fechaInicio;

        $this->updateDescripcion();

        return $this;
    }

    public function getFechaFinal(): ?\DateTimeInterface
    {
        return $this->fechaFinal;
    }

    public function setFechaFinal(\DateTimeInterface $fechaFinal): self
    {
        $this->fechaFinal = $fechaFinal;

        $this->updateDescripcion();

        return $this;
    }

    /**
     * @return Collection<int, Grupo>
     */
    public function getGrupos(): Collection
    {
        return $this->grupos;
    }

    public function addGrupo(Grupo $grupo): self
    {
        if (!$this->grupos->contains($grupo)) {
            $this->grupos->add($grupo);
            $grupo->setCursoAcademico($this);
        }

        return $this;
    }

    public function removeGrupo(Grupo $grupo): self
    {
        if ($this->grupos->removeElement($grupo)) {
            // set the owning side to null (unless already changed)
            if ($grupo->getCursoAcademico() === $this) {
                $grupo->setCursoAcademico(null);
            }
        }

        return $this;
    }

    private function updateDescripcion(): void
    {
        if ($this->fechaInicio && $this->fechaFinal) {
            $this->descripcion = $this->fechaInicio->format('Y') . '/' . $this->fechaFinal->format('Y');
        }
    }
}
