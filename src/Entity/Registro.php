<?php

namespace App\Entity;

use App\Repository\RegistroRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegistroRepository::class)]
class Registro
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $horaSalida = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $horaEntrada = null;

    #[ORM\ManyToOne(inversedBy: 'registros')]
    private ?Usuario $responsable = null;

    #[ORM\ManyToOne(inversedBy: 'registros')]
    private ?Estudiante $estudiante = null;

    #[ORM\ManyToOne(inversedBy: 'registros')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Llave $llave = null;

    #[ORM\ManyToMany(targetEntity: Motivo::class, inversedBy: 'registros')]
    private Collection $motivos;

    public function __construct()
    {
        $this->motivos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHoraSalida(): ?\DateTimeInterface
    {
        return $this->horaSalida;
    }

    public function setHoraSalida(\DateTimeInterface $horaSalida): static
    {
        $this->horaSalida = $horaSalida;

        return $this;
    }

    public function getHoraEntrada(): ?\DateTimeInterface
    {
        return $this->horaEntrada;
    }

    public function setHoraEntrada(\DateTimeInterface $horaEntrada): static
    {
        $this->horaEntrada = $horaEntrada;

        return $this;
    }

    public function getResponsable(): ?Usuario
    {
        return $this->responsable;
    }

    public function setResponsable(?Usuario $responsable): static
    {
        $this->responsable = $responsable;

        return $this;
    }

    public function getEstudiante(): ?Estudiante
    {
        return $this->estudiante;
    }

    public function setEstudiante(?Estudiante $estudiante): static
    {
        $this->estudiante = $estudiante;

        return $this;
    }

    public function getLlave(): ?Llave
    {
        return $this->llave;
    }

    public function setLlave(?Llave $llave): static
    {
        $this->llave = $llave;

        return $this;
    }

    /**
     * @return Collection<int, Motivo>
     */
    public function getMotivos(): Collection
    {
        return $this->motivos;
    }

    public function addMotivo(Motivo $motivo): static
    {
        if (!$this->motivos->contains($motivo)) {
            $this->motivos->add($motivo);
        }

        return $this;
    }

    public function removeMotivo(Motivo $motivo): static
    {
        $this->motivos->removeElement($motivo);

        return $this;
    }
}
