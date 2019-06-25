<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoomsRepository")
 */
class Rooms
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
    private $Room_name;

    /**
     * @ORM\Column(type="integer")
     */
    private $Room_price;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="Room_id")
     */
    private $Room_id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Extra", mappedBy="Room_number", cascade={"persist", "remove"})
     */
    private $Room_number;

    public function __construct()
    {
        $this->Room_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoomName(): ?string
    {
        return $this->Room_name;
    }

    public function setRoomName(string $Room_name): self
    {
        $this->Room_name = $Room_name;

        return $this;
    }

    public function getRoomPrice(): ?int
    {
        return $this->Room_price;
    }

    public function setRoomPrice(int $Room_price): self
    {
        $this->Room_price = $Room_price;

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getRoomId(): Collection
    {
        return $this->Room_id;
    }

    public function addRoomId(Reservation $roomId): self
    {
        if (!$this->Room_id->contains($roomId)) {
            $this->Room_id[] = $roomId;
            $roomId->setRoomId($this);
        }

        return $this;
    }

    public function removeRoomId(Reservation $roomId): self
    {
        if ($this->Room_id->contains($roomId)) {
            $this->Room_id->removeElement($roomId);
            // set the owning side to null (unless already changed)
            if ($roomId->getRoomId() === $this) {
                $roomId->setRoomId(null);
            }
        }

        return $this;
    }

    public function getRoomNumber(): ?Extra
    {
        return $this->Room_number;
    }

    public function setRoomNumber(Extra $Room_number): self
    {
        $this->Room_number = $Room_number;

        // set the owning side of the relation if necessary
        if ($this !== $Room_number->getRoomNumber()) {
            $Room_number->setRoomNumber($this);
        }

        return $this;
    }

    public function __toString()
    {
        return ''.$this->getId();
    }
}
