<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SeasonRepository")
 */
class Season
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $Begin_date;

    /**
     * @ORM\Column(type="date")
     */
    private $End_date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Season_name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Discount;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Reservation", mappedBy="Season_number", cascade={"persist", "remove"})
     */
    private $Season_number;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBeginDate(): ?\DateTimeInterface
    {
        return $this->Begin_date;
    }

    public function setBeginDate(\DateTimeInterface $Begin_date): self
    {
        $this->Begin_date = $Begin_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->End_date;
    }

    public function setEndDate(\DateTimeInterface $End_date): self
    {
        $this->End_date = $End_date;

        return $this;
    }

    public function getSeasonName(): ?string
    {
        return $this->Season_name;
    }

    public function setSeasonName(string $Season_name): self
    {
        $this->Season_name = $Season_name;

        return $this;
    }

    public function getDiscount(): ?int
    {
        return $this->Discount;
    }

    public function setDiscount(?int $Discount): self
    {
        $this->Discount = $Discount;

        return $this;
    }

    public function getSeasonNumber(): ?Reservation
    {
        return $this->Season_number;
    }

    public function setSeasonNumber(?Reservation $Season_number): self
    {
        $this->Season_number = $Season_number;

        // set (or unset) the owning side of the relation if necessary
        $newSeason_number = $Season_number === null ? null : $this;
        if ($newSeason_number !== $Season_number->getSeasonNumber()) {
            $Season_number->setSeasonNumber($newSeason_number);
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getSeasonName();
    }
}
