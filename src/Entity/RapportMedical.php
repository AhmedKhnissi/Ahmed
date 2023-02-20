<?php

namespace App\Entity;

use App\Repository\RapportMedicalRepository;
use Doctrine\ORM\Mapping as ORM;
use http\Message;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RapportMedicalRepository::class)]
class RapportMedical
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 255)]
    /**
     * @Assert\Length(
     * min = 5,
     * max = 50 ,
     * minMessage = "La description doit contenir au moins 5 caractères.",
     * maxMessage = "a description doit contenir au maximum 50 caractères.")
     */
    private ?string $Description = null;

    #[ORM\OneToOne(inversedBy: 'rapportMedical',cascade: ['persist', 'remove'])]
    private ?Animal $Animal = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getRendezVous(): ?RendezVous
    {
        return $this->rendezVous;
    }

    public function setRendezVous(?RendezVous $rendezVous): self
    {
        // unset the owning side of the relation if necessary
        if ($rendezVous === null && $this->rendezVous !== null) {
            $this->rendezVous->setRapportMedical(null);
        }

        // set the owning side of the relation if necessary
        if ($rendezVous !== null && $rendezVous->getRapportMedical() !== $this) {
            $rendezVous->setRapportMedical($this);
        }

        $this->rendezVous = $rendezVous;

        return $this;
    }

    public function getAnimal(): ?Animal
    {
        return $this->Animal;
    }

    public function setAnimal(?Animal $Animal): self
    {
        $this->Animal = $Animal;

        return $this;
    }
}
