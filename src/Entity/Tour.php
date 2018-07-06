<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ToursRepository")
 */
class Tour
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $base_cost;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Client", mappedBy="tour")
     */
    private $clients_collection;

    public function __construct()
    {
        $this->clients_collection = new ArrayCollection();
    }

    public function getId()
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getBaseCost(): ?int
    {
        return $this->base_cost;
    }

    public function setBaseCost(int $base_cost): self
    {
        $this->base_cost = $base_cost;

        return $this;
    }

    /**
     * @return Collection|Client[]
     */
    public function getClientsCollection(): Collection
    {
        return $this->clients_collection;
    }

    public function addClientsCollection(Client $clientsCollection): self
    {
        if (!$this->clients_collection->contains($clientsCollection)) {
            $this->clients_collection[] = $clientsCollection;
            $clientsCollection->setTour($this);
        }

        return $this;
    }

    public function removeClientsCollection(Client $clientsCollection): self
    {
        if ($this->clients_collection->contains($clientsCollection)) {
            $this->clients_collection->removeElement($clientsCollection);
            // set the owning side to null (unless already changed)
            if ($clientsCollection->getTour() === $this) {
                $clientsCollection->setTour(null);
            }
        }

        return $this;
    }

    /**
     * Generates the magic method
     *
     */
    public function __toString(): string
    {
        return $this->name;
    }
}
