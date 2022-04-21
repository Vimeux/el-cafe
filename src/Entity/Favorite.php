<?php

namespace App\Entity;

use App\Repository\FavoriteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FavoriteRepository::class)
 */
class Favorite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=coffee::class, inversedBy="favorite")
     */
    private $id_coffee;

    /**
     * @ORM\OneToMany(targetEntity=user::class, mappedBy="favorite")
     */
    private $id_user;

    public function __construct()
    {
        $this->id_coffee = new ArrayCollection();
        $this->id_user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, coffee>
     */
    public function getIdCoffee(): Collection
    {
        return $this->id_coffee;
    }

    public function addIdCoffee(coffee $idCoffee): self
    {
        if (!$this->id_coffee->contains($idCoffee)) {
            $this->id_coffee[] = $idCoffee;
        }

        return $this;
    }

    public function removeIdCoffee(coffee $idCoffee): self
    {
        $this->id_coffee->removeElement($idCoffee);

        return $this;
    }

    /**
     * @return Collection<int, user>
     */
    public function getIdUser(): Collection
    {
        return $this->id_user;
    }

    public function addIdUser(user $idUser): self
    {
        if (!$this->id_user->contains($idUser)) {
            $this->id_user[] = $idUser;
            $idUser->setFavorite($this);
        }

        return $this;
    }

    public function removeIdUser(user $idUser): self
    {
        if ($this->id_user->removeElement($idUser)) {
            // set the owning side to null (unless already changed)
            if ($idUser->getFavorite() === $this) {
                $idUser->setFavorite(null);
            }
        }

        return $this;
    }
}
