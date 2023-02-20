<?php

namespace App\Entity;

use App\Repository\RendezVousRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RendezVousRepository::class)]
class RendezVous
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    /**
     * @Assert\NotBlank
     * @Assert\Regex(
     * pattern="#^(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[0-2])/[0-9]{4}$#",
     * message="La date doit être sous la forme JJ/MM/YYYY avec JJ entre 1 et 31, MM entre 1 et 12 et YYYY étant une année à 4 chiffres."
     * )
     */
    private ?string $date = null;

    #[ORM\Column(length: 255)]
    /**
     * @Assert\Regex(
     * pattern="/^([0-1][0-9]|2[0-3]):[0-5][0-9]$/",
     * message="L'heure doit être au format HH:MM avec HH entre 00 et 23 et MM entre 00 et 59 ."
     * )
     */
    private ?string $heure = null;



    #[ORM\Column(length: 255)]
    /**
     * @Assert\Length(
     * max = 15,
     * maxMessage = "La race de lanimal ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private ?string $raceanimal = null;

    #[ORM\Column(length: 255)]
    /**
     * @Assert\Length(
     * max = 15,
     * maxMessage = "Le Nom de lanimal ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private ?string $nomanimal = null;



    #[ORM\ManyToOne(inversedBy: 'rendezVouses')]
    private ?Veterinaire $Veterinaire = null;

    #[ORM\ManyToOne(inversedBy: 'rendezVouses')]
    private ?Decision $Decision = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHeure(): ?string
    {
        return $this->heure;
    }

    public function setHeure(string $heure): self
    {
        $this->heure = $heure;

        return $this;
    }

    public function getNomvet(): ?string
    {
        return $this->nomvet;
    }

    public function setNomvet(string $nomvet): self
    {
        $this->nomvet = $nomvet;

        return $this;
    }

    public function getRaceanimal(): ?string
    {
        return $this->raceanimal;
    }

    public function setRaceanimal(string $raceanimal): self
    {
        $this->raceanimal = $raceanimal;

        return $this;
    }

    public function getNomanimal(): ?string
    {
        return $this->nomanimal;
    }

    public function setNomanimal(string $nomanimal): self
    {
        $this->nomanimal = $nomanimal;

        return $this;
    }

    public function getRapportMedical(): ?RapportMedical
    {
        return $this->RapportMedical;
    }

    public function setRapportMedical(?RapportMedical $RapportMedical): self
    {
        $this->RapportMedical = $RapportMedical;

        return $this;
    }


    public function getVeterinaire(): ?Veterinaire
    {
        return $this->Veterinaire;
    }

    public function setVeterinaire(?Veterinaire $Veterinaire): self
    {
        $this->Veterinaire = $Veterinaire;

        return $this;
    }

    public function getDecision(): ?Decision
    {
        return $this->Decision;
    }

    public function setDecision(?Decision $Decision): self
    {
        $this->Decision = $Decision;

        return $this;
    }
}
