<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tail;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $phone;

    /**
     * One Client has many ClientTourCosts
     * @ORM\OneToMany(targetEntity="ClientTourCost", mappedBy="client")
     */
    private $clientTourCosts;

    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->clientTourCosts = new ArrayCollection;
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

    public function getTail(): ?int
    {
        return $this->tail;
    }

    public function setTail(?int $tail): self
    {
        $this->tail = $tail;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getClientTourCosts()
    {
        return $this->clientTourCosts->toArray();
    }

    /**
     * @param mixed $clientTourCosts
     */
    public function setClientTourCosts($clientTourCosts)
    {
        $this->clientTourCosts = $clientTourCosts;
    }

    public function __toString()
    {
        return $this->name;
    }
}
