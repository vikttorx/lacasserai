<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExtraRepository")
 */
class Extra
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Rooms", inversedBy="Room_number", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Room_number;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoomNumber(): ?Rooms
    {
        return $this->Room_number;
    }

    public function setRoomNumber(Rooms $Room_number): self
    {
        $this->Room_number = $Room_number;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(?string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    public function __toString()
    {
        return ''.$this->getRoomNumber();
    }
}
