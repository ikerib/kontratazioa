<?php

namespace App\Entity;

use App\Repository\NotificationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NotificationRepository::class)
 */
class Notification
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Erabiltzailea::class, inversedBy="notifications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $erabiltzailea;

    /**
     * @ORM\Column(type="datetime")
     */
    private $noiz;

    /**
     * @ORM\ManyToOne(targetEntity=KontratuaLote::class, inversedBy="notifications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $lote;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getErabiltzailea(): ?Erabiltzailea
    {
        return $this->erabiltzailea;
    }

    public function setErabiltzailea(?Erabiltzailea $erabiltzailea): self
    {
        $this->erabiltzailea = $erabiltzailea;

        return $this;
    }

    public function getNoiz(): ?\DateTimeInterface
    {
        return $this->noiz;
    }

    public function setNoiz(\DateTimeInterface $noiz): self
    {
        $this->noiz = $noiz;

        return $this;
    }

    public function getLote(): ?KontratuaLote
    {
        return $this->lote;
    }

    public function setLote(?KontratuaLote $lote): self
    {
        $this->lote = $lote;

        return $this;
    }
}
