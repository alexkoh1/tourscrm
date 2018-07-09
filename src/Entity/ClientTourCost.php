<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientsToursCostRepository")
 */
class ClientTourCost
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Many ClientTourCosts have One Client.
     *
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="clientTourCosts")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id", nullable=false)
     */
    private $client;

    /**
     * Many ClientTourCosts have One Tour.
     *
     * @ORM\ManyToOne(targetEntity="Tour", inversedBy="clientTourCosts")
     * @ORM\JoinColumn(name="tour_id", referencedColumnName="id", nullable=false)
     */
    private $tour;

    /**
     * @ORM\Column(type="integer")
     */
    private $cost;

    public function getId()
    {
        return $this->id;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getTour(): ?Tour
    {
        return $this->tour;
    }

    public function setTour(Tour $tour): self
    {
        $this->tour = $tour;

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
