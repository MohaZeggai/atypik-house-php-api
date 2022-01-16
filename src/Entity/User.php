<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"user"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     * @Groups({"user"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=25)
     * @Groups({"user"})
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user"})
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user"})
     */
    private $image;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"user"})
     */
    private $date_naissance;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     * @Groups({"user"})
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user"})
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=25)
     * @Groups({"user"})
     */
    private $role;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(?\DateTimeInterface $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection|Location[]
     */
    // public function getLocations(): Collection
    // {
    //     return $this->locations;
    // }

    // public function addLocation(Location $location): self
    // {
    //     if (!$this->locations->contains($location)) {
    //         $this->locations[] = $location;
    //         $location->setUser($this);
    //     }

    //     return $this;
    // }

    // public function removeLocation(Location $location): self
    // {
    //     if ($this->locations->removeElement($location)) {
    //         // set the owning side to null (unless already changed)
    //         if ($location->getUser() === $this) {
    //             $location->setUser(null);
    //         }
    //     }

    //     return $this;
    // }
}
