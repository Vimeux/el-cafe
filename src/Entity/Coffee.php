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
    private $seed_type;

    /**
     * @ORM\ManyToMany(targetEntity=CoffeeShop::class, mappedBy="id_coffee")
     */
    private $coffeeshop;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="Favorite")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
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
        return $this->seed_type;
    }

    public function addSeedType(SeedType $seedType): self
    {
        if (!$this->seed_type->contains($seedType)) {
            $this->seed_type[] = $seedType;
        }

        return $this;
    }

    public function removeSeedType(SeedType $seedType): self
    {
        $this->seed_type->removeElement($seedType);

        return $this;
    }

    /**
     * @return Collection<int, Coffeeshop>
     */
    public function getCoffeeshop(): ?Collection
    {
        return $this->coffeeshop;
    }

    public function addCoffeeshop(CoffeeShop $coffeeshop): self
    {
        if (!$this->coffeeshop->contains($coffeeshop)) {
            $this->coffeeshop[] = $coffeeshop;
            $coffeeshop->addIdCoffee($this);
        }

        return $this;
    }

    public function removeCoffeeshop(CoffeeShop $coffeeshop): self
    {
        if ($this->coffeeshop->removeElement($coffeeshop)) {
            $coffeeshop->removeIdCoffee($this);
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
