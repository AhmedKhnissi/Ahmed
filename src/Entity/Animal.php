<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $Nom = null;

    #[ORM\Column(length: 10)]
    private ?string $Race = null;

    #[ORM\Column]
    private ?int $Age = null;

    #[ORM\Column]
    private ?int $Poids = null;

    #[ORM\Column(length: 15)]
    private ?string $Propriétaire = null;

    #[ORM\OneToOne(mappedBy: 'Animal', cascade: ['persist', 'remove'])]
    private ?RapportMedical $rapportMedical = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getRace(): ?string
    {
        return $this->Race;
    }

    public function setRace(string $Race): self
    {
        $this->Race = $Race;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->Age;
    }

    public function setAge(int $Age): self
    {
        $this->Age = $Age;

        return $this;
    }

    public function getPoids(): ?int
    {
        return $this->Poids;
    }

    public function setPoids(int $Poids): self
    {
        $this->Poids = $Poids;

        return $this;
    }

    public function getPropriétaire(): ?string
    {
        return $this->Propriétaire;
    }

    public function setPropriétaire(string $Propriétaire): self
    {
        $this->Propriétaire = $Propriétaire;

        return $this;
    }
    public function getRapportMedical(): ?RapportMedical
    {
        return $this->rapportMedical;
    }
}
