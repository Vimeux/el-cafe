<?php

namespace App\Entity;

use App\Repository\CoffeeShopRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoffeeShopRepository::class)
 */
class CoffeeShop
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @ORM\ManyToMany(targetEntity=Coffee::class, inversedBy="coffeeshop")
     */
    private $id_coffee;

    public function __construct()
    {
        $this->id_coffee = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    /**
     * @return Collection<int, Coffee>
     */
    public function getIdCoffee(): Collection
    {
        return $this->id_coffee;
    }

    public function addIdCoffee(Coffee $idCoffee): self
    {
        if (!$this->id_coffee->contains($idCoffee)) {
            $this->id_coffee[] = $idCoffee;
        }

        return $this;
    }

    public function removeIdCoffee(Coffee $idCoffee): self
    {
        $this->id_coffee->removeElement($idCoffee);

        return $this;
    }
}
