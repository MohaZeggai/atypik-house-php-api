<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\LocationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LocationRepository::class)
 */
class Location
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"location"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="locations", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"user"})
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"location"})
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=25)
     * @Groups({"location"})
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=15)
     * @Groups({"location"})
     */
    private $surface;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"location"})
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"location"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"location"})
     */
    private $planning;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"location"})
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"location"})
     */
    private $adresse;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSurface(): ?string
    {
        return $this->surface;
    }

    public function setSurface(string $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPlanning(): ?string
    {
        return $this->planning;
    }

    public function setPlanning(string $planning): self
    {
        $this->planning = $planning;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }
}
