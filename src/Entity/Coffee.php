<?php

namespace App\Entity;

use App\Repository\CoffeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoffeeRepository::class)
 */
class Coffee
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
     * @ORM\Column(type="integer")
     */
    private $intensity;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $origin;

    /**
     * @ORM\ManyToMany(targetEntity=SeedType::class, inversedBy="coffee")
     */
    private $seedType;

    /**
     * @ORM\ManyToMany(targetEntity=CoffeeShop::class, mappedBy="id_coffee")
     */
    private $coffeeShop;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="Favorite")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->seedType = new ArrayCollection();
        $this->coffeeShop = new ArrayCollection();
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

    public function getIntensity(): ?int
    {
        return $this->intensity;
    }

    public function setIntensity(int $intensity): self
    {
        $this->intensity = $intensity;

        return $this;
    }

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function setOrigin(string $origin): self
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * @return Collection<int, seedtype>
     */
    public function getSeedType(): ?Collection
    {
        return $this->seedType;
    }

    public function addSeedType(SeedType $seedType): self
    {
        // var_dump($this->$seedType);
        if (!$this->seedType->contains($seedType)) {
            $this->seedType[] = $seedType;
        }

        return $this;
    }

    public function removeSeedType(SeedType $seedType): self
    {
        $this->seedType->removeElement($seedType);

        return $this;
    }

    /**
     * @return Collection<int, Coffeeshop>
     */
    public function getCoffeeshop(): ?Collection
    {
        return $this->coffeeShop;
    }

    public function addCoffeeshop(CoffeeShop $coffeeShop): self
    {
        if (!$this->coffeeShop->contains($coffeeShop)) {
            $this->coffeeShop[] = $coffeeShop;
            $coffeeShop->addIdCoffee($this);
        }

        return $this;
    }

    public function removeCoffeeshop(CoffeeShop $coffeeShop): self
    {
        if ($this->coffeeShop->removeElement($coffeeShop)) {
            $coffeeShop->removeIdCoffee($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addFavorite($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeFavorite($this);
        }

        return $this;
    }

    public function __toString()
    {
      return $this->name;
    }
}
