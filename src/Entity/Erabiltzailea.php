<?php

namespace App\Entity;

use App\Repository\ErabiltzaileaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use PasaiakoUdala\AuthBundle\Entity\User;


/**
 * @ORM\Entity(repositoryClass=ErabiltzaileaRepository::class)
 */
class Erabiltzailea extends User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Notification::class, mappedBy="erabiltzailea", orphanRemoval=true)
     */
    private $notifications;

    public function __construct()
    {
        $this->notifications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Notification[]
     */
    public function getNotifications(): Collection
    {
        return $this->notifications;
    }

    public function addNotification(Notification $notification): self
    {
        if (!$this->notifications->contains($notification)) {
            $this->notifications[] = $notification;
            $notification->setErabiltzailea($this);
        }

        return $this;
    }

    public function removeNotification(Notification $notification): self
    {
        if ($this->notifications->removeElement($notification)) {
            // set the owning side to null (unless already changed)
            if ($notification->getErabiltzailea() === $this) {
                $notification->setErabiltzailea(null);
            }
        }

        return $this;
    }
}
