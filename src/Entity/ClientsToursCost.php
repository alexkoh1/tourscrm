<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientsToursCostRepository")
 */
class ClientsToursCost
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Client", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $client_id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Tour", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $tour_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $cost;

    public function getId()
    {
        return $this->id;
    }

    public function getClientId(): ?Client
    {
        return $this->client_id;
    }

    public function setClientId(Client $client_id): self
    {
        $this->client_id = $client_id;

        return $this;
    }

    public function getTourId(): ?Tour
    {
        return $this->tour_id;
    }

    public function setTourId(Tour $tour_id): self
    {
        $this->tour_id = $tour_id;

        return $this;
    }

    public function getCost(): ?int
    {
        return $this->cost;
    }

    public function setCost(int $cost): self
    {
        $this->cost = $cost;

        return $this;
    }
}
