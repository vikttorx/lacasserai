<?php
// src/Entity/User.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="User_id")
     */
    private $User_id;

    public function __construct()
    {
        parent::__construct();
        $this->User_id = new ArrayCollection();
        // your own logic
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getUserId(): Collection
    {
        return $this->User_id;
    }

    public function addUserId(Reservation $userId): self
    {
        if (!$this->User_id->contains($userId)) {
            $this->User_id[] = $userId;
            $userId->setUserId($this);
        }

        return $this;
    }

    public function removeUserId(Reservation $userId): self
    {
        if ($this->User_id->contains($userId)) {
            $this->User_id->removeElement($userId);
            // set the owning side to null (unless already changed)
            if ($userId->getUserId() === $this) {
                $userId->setUserId(null);
            }
        }

        return $this;
    }
}