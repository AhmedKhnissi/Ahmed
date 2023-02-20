<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert; 

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
     /** 
       *@Assert\NotBlank(message="email doit etre non vide") 
       *@Assert\Email(message="email incorrect")   
    */ 
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
     /** 
       *@Assert\NotBlank(message="mot de passe doit etre non vide")    
    */ 
    private ?string $password = null;

    #[ORM\Column(length: 100, nullable: true)]
     /** 
       *@Assert\NotBlank(message="nom doit etre non vide")    
    */
    private ?string $nom = null;

    #[ORM\Column(length: 100, nullable: true)]
     /** 
       *@Assert\NotBlank(message="prenom doit etre non vide")    
    */
    private ?string $prenom = null;

    #[ORM\Column(length: 100, nullable: true)]
     /** 
       *@Assert\NotBlank(message="pays doit etre non vide")    
    */
    private ?string $pays = null;

    #[ORM\Column(length: 100, nullable: true)]
     /** 
       *@Assert\NotBlank(message="gouvernorat doit etre non vide")    
    */
    private ?string $gouvernorat = null;

    #[ORM\Column(length: 100, nullable: true)]
     /** 
       *@Assert\NotBlank(message="ville doit etre non vide")    
    */
    private ?string $ville = null;

    #[ORM\Column(length: 100, nullable: true)]
     /** 
       *@Assert\NotBlank(message="rue doit etre non vide")    
    */
    private ?string $rue = null;

    #[ORM\Column(length: 100, nullable: true)]
     /** 
       *@Assert\NotBlank(message="telephone doit etre non vide")    
    */
    private ?string $telephone = null;

    #[ORM\Column(length: 100, nullable: true)]

     /** 
       *@Assert\NotBlank(message="permis doit etre non vide")    
    */ 
    private ?string $permistravail = null;

    #[ORM\Column(nullable: true)]
    private ?int $bloque = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(?string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getGouvernorat(): ?string
    {
        return $this->gouvernorat;
    }

    public function setGouvernorat(?string $gouvernorat): self
    {
        $this->gouvernorat = $gouvernorat;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(?string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getPermistravail(): ?string
    {
        return $this->permistravail;
    }

    public function setPermistravail(?string $permistravail): self
    {
        $this->permistravail = $permistravail;

        return $this;
    }

    public function getBloque(): ?int
    {
        return $this->bloque;
    }

    public function setBloque(?int $bloque): self
    {
        $this->bloque = $bloque;

        return $this;
    }

    /**
     * @return Collection<int, RendezVous>
     */
    public function getRendezVouses(): Collection
    {
        return $this->rendezVouses;
    }

    public function addRendezVouse(RendezVous $rendezVouse): self
    {
        if (!$this->rendezVouses->contains($rendezVouse)) {
            $this->rendezVouses->add($rendezVouse);
            $rendezVouse->setUser($this);
        }

        return $this;
    }

    public function removeRendezVouse(RendezVous $rendezVouse): self
    {
        if ($this->rendezVouses->removeElement($rendezVouse)) {
            // set the owning side to null (unless already changed)
            if ($rendezVouse->getUser() === $this) {
                $rendezVouse->setUser(null);
            }
        }

        return $this;
    }
}
