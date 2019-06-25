<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Creation_date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Arrival_date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Departure_time;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="User_id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $User_id;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rooms", inversedBy="Room_id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Room_id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Season", inversedBy="Season_number", cascade={"persist", "remove"})
     */
    private $Season_number;

    /**
     * @ORM\Column(type="integer")
     */
    private $Adults;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Children;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Payment", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Payment_id;




    /**


     */


    public function __construct()
    {
        $this->Reservation_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->Creation_date;
    }

    public function setCreationDate(\DateTimeInterface $Creation_date): self
    {
        $this->Creation_date = $Creation_date;

        return $this;
    }

    public function getArrivalDate(): ?\DateTimeInterface
    {
        return $this->Arrival_date;
    }

    public function setArrivalDate(\DateTimeInterface $Arrival_date): self
    {
        $this->Arrival_date = $Arrival_date;

        return $this;
    }

    public function getDepartureTime(): ?\DateTimeInterface
    {
        return $this->Departure_time;
    }

    public function setDepartureTime(\DateTimeInterface $Departure_time): self
    {
        $this->Departure_time = $Departure_time;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->User_id;
    }

    public function setUserId(?User $User_id): self
    {
        $this->User_id = $User_id;

        return $this;
    }


    public function getRoomId(): ?Rooms
    {
        return $this->Room_id;
    }

    public function setRoomId(?Rooms $Room_id): self
    {
        $this->Room_id = $Room_id;

        return $this;
    }

    public function getSeasonNumber(): ?Season
    {
        return $this->Season_number;
    }

    public function setSeasonNumber(?Season $Season_number): self
    {
        $this->Season_number = $Season_number;

        return $this;
    }

    public function getAdults(): ?int
    {
        return $this->Adults;
    }

    public function setAdults(int $Adults): self
    {
        $this->Adults = $Adults;

        return $this;
    }

    public function getChildren(): ?int
    {
        return $this->Children;
    }

    public function setChildren(?int $Children): self
    {
        $this->Children = $Children;

        return $this;
    }

    public function getPaymentId(): ?Payment
    {
        return $this->Payment_id;
    }

    public function setPaymentId(Payment $Payment_id): self
    {
        $this->Payment_id = $Payment_id;

        return $this;
    }






}

