<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PaymentRepository")
 */
class Payment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $Payment_number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Payment_method;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPaymentNumber(): ?int
    {
        return $this->Payment_number;
    }

    public function setPaymentNumber(int $Payment_number): self
    {
        $this->Payment_number = $Payment_number;

        return $this;
    }

    public function getPaymentMethod(): ?string
    {
        return $this->Payment_method;
    }

    public function setPaymentMethod(string $Payment_method): self
    {
        $this->Payment_method = $Payment_method;

        return $this;
    }

    public function __toString()
    {
        return ''.$this->getPaymentNumber();
    }
}
