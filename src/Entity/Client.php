<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="string", length=18, nullable=true)
     */
    private $phone;

    /**
     * @ORM\OneToMany(targetEntity="Payment", mappedBy="client", orphanRemoval=true)
     */
    private $payments;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tour", mappedBy="clients")
     */
    private $tours;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $vk;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $telegram;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isLead;

    /**
     * @ORM\Column(type="string", length=11, nullable=true)
     */
    private $vkId;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $bday;

    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->payments = new ArrayCollection();
        $this->tours = new ArrayCollection();
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
     * @return Tour[]
     */
    public function getTours()
    {
        return $this->tours->toArray();
    }

    /**
     * @param Tour $tour
     */
    public function addTour(Tour $tour)
    {
        $this->tours->add($tour);
        $tour->addClient($this);
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Collection|Payment[]
     */
    public function getPayments(): Collection
    {
        return $this->payments;
    }

    /**
     * @param Payment $payment
     *
     * @return Client
     */
    public function addPayment(Payment $payment): self
    {
        if (!$this->payments->contains($payment)) {
            $this->payments[] = $payment;
            $payment->setClient($this);
        }

        return $this;
    }

    /**
     * @param Payment $payment
     *
     * @return Client
     */
    public function removePayment(Payment $payment): self
    {
        if ($this->payments->contains($payment)) {
            $this->payments->removeElement($payment);
            // set the owning side to null (unless already changed)
            if ($payment->getClient() === $this) {
                $payment->setClient(null);
            }
        }

        return $this;
    }

    public function removeTour(Tour $tour): self
    {
        if ($this->tours->contains($tour)) {
            $this->tours->removeElement($tour);
        }

        return $this;
    }

    public function getVk(): ?string
    {
        return $this->vk;
    }

    public function setVk(?string $vk): self
    {
        $this->vk = $vk;

        return $this;
    }

    public function getTelegram(): ?string
    {
        return $this->telegram;
    }

    public function setTelegram(?string $telegram): self
    {
        $this->telegram = $telegram;

        return $this;
    }

    public function getIsLead(): ?bool
    {
        return $this->isLead;
    }

    public function setIsLead(?bool $isLead): self
    {
        $this->isLead = $isLead;

        return $this;
    }

    public function getVkId(): ?string
    {
        return $this->vkId;
    }

    public function setVkId(?string $vkId): self
    {
        $this->vkId = $vkId;

        return $this;
    }

    public function getBday(): ?\DateTimeInterface
    {
        return $this->bday;
    }

    public function setBday(?\DateTimeInterface $bday): self
    {
        $this->bday = $bday;

        return $this;
    }
}
