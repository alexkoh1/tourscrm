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
     * One Tour has many ClientTourCosts
     * @ORM\OneToMany(targetEntity="ClientTourCost", mappedBy="tour")
     */
    private $clientTourCosts;

    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->clientTourCosts = new ArrayCollection;
    }

    public function getClientTourCosts()
    {
        return $this->clientTourCosts->toArray();
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
     * Generates the magic method
     *
     */
    public function __toString(): string
    {
        return $this->name.' '.$this->date->format('d-m-Y');
    }
}
