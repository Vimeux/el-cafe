<?php

namespace App\Entity;

use App\Repository\SeedTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SeedTypeRepository::class)
 */
class SeedType
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
     * @ORM\ManyToMany(targetEntity=Coffee::class, mappedBy="seed_type")
     */
    private $coffee;

    public function __construct()
    {
        $this->coffee = new ArrayCollection();
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

    /**
     * @return Collection<int, Coffee>
     */
    public function getCoffee(): Collection
    {
        return $this->coffee;
    }

    public function addCoffee(Coffee $coffee): self
    {
        if (!$this->coffee->contains($coffee)) {
            $this->coffee[] = $coffee;
            $coffee->addSeedType($this);
        }

        return $this;
    }

    public function removeCoffee(Coffee $coffee): self
    {
        if ($this->coffee->removeElement($coffee)) {
            $coffee->removeSeedType($this);
        }

        return $this;
    }
}
