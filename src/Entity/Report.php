<?php

namespace App\Entity;

use App\Repository\ReportRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReportRepository::class)]
class Report
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Habitat = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom_animal = null;

    #[ORM\Column(length: 255)]
    private ?string $Race = null;

    #[ORM\Column(length: 255)]
    private ?string $Commentaires = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHabitat(): ?string
    {
        return $this->Habitat;
    }

    public function setHabitat(string $Habitat): static
    {
        $this->Habitat = $Habitat;

        return $this;
    }

    public function getNomAnimal(): ?string
    {
        return $this->Nom_animal;
    }

    public function setNomAnimal(string $Nom_animal): static
    {
        $this->Nom_animal = $Nom_animal;

        return $this;
    }

    public function getRace(): ?string
    {
        return $this->Race;
    }

    public function setRace(string $Race): static
    {
        $this->Race = $Race;

        return $this;
    }

    public function getCommentaires(): ?string
    {
        return $this->Commentaires;
    }

    public function setCommentaires(string $Commentaires): static
    {
        $this->Commentaires = $Commentaires;

        return $this;
    }
}
